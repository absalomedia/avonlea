<?php

namespace Invoice;

class Invoice extends CI_Model
{
    public function __construct()
    {
        return parent::__construct();
    }

    // --------------------------------------------------------------------

    public function addInvoice($invoice_data)
    {
        if ($this->db->insert('invoices', $invoice_data)) {
            return $this->db->insert_id();
        } else {
            return false;
        }
    }

    public function addInvoiceItem($invoice_items)
    {
        if ($this->db->insert('invoice_items', $invoice_items)) {
            return true;
        } else {
            return false;
        }
    }

    // --------------------------------------------------------------------

    public function updateInvoice($invoice_id, $invoice_data)
    {
        $this->db->where('id', $invoice_id);

        if ($this->db->update('invoices', $invoice_data)) {
            return $invoice_id;
        } else {
            return false;
        }
    }

    // --------------------------------------------------------------------

    public function payment($invoice_data)
    {
        if ($this->db->insert('invoice_payments', $invoice_data)) {
            return $invoice_data['invoice_id'];
        } else {
            return false;
        }
    }

    // --------------------------------------------------------------------

    public function deleteInvoice($invoice_id)
    {
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('invoice_payments'); // remove invoice payments

        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('invoice_histories'); // remove invoice_histories info

        $this->db->where('id', $invoice_id);
        $this->db->delete('invoices'); // remove invoice info

        $this->deleteInvoice_items($invoice_id); // remove invoice items
    }

    // --------------------------------------------------------------------

    public function deleteInvoiceItems($invoice_id)
    {
        $this->db->where('invoice_id', $invoice_id);
        $this->db->delete('invoice_items');
    }

    // --------------------------------------------------------------------

    public function getSingleInvoice($invoice_id)
    {
        $this->db->select('invoices.*, clients.name, clients.address1, clients.address2, clients.city, clients.country, clients.province, clients.website, clients.postal_code, clients.tax_code');
        $this->db->select('(SELECT SUM('.$this->db->dbprefix('invoice_payments').'.amount_paid) FROM '.$this->db->dbprefix('invoice_payments').' WHERE '.$this->db->dbprefix('invoice_payments').'.invoice_id='.$invoice_id.') AS amount_paid', false);
        $this->db->select('TO_DAYS('.$this->db->dbprefix('invoices').'.dateIssued) - TO_DAYS(curdate()) AS daysOverdue', false);
        $this->db->select('(SELECT SUM('.$this->db->dbprefix('invoice_items').'.amount * '.$this->db->dbprefix('invoice_items').'.quantity) FROM '.$this->db->dbprefix('invoice_items').' WHERE '.$this->db->dbprefix('invoice_items').'.invoice_id='.$invoice_id.') AS total_notax', false);
        $this->db->select('(SELECT SUM('.$this->db->dbprefix('invoice_items').'.amount * '.$this->db->dbprefix('invoice_items').'.quantity * ('.$this->db->dbprefix('invoices').'.tax1_rate/100 * '.$this->db->dbprefix('invoice_items').'.taxable)) FROM '.$this->db->dbprefix('invoice_items').' WHERE '.$this->db->dbprefix('invoice_items').'.invoice_id='.$invoice_id.') AS total_tax1', false);
        $this->db->select('(SELECT SUM('.$this->db->dbprefix('invoice_items').'.amount * '.$this->db->dbprefix('invoice_items').'.quantity * ('.$this->db->dbprefix('invoices').'.tax2_rate/100 * '.$this->db->dbprefix('invoice_items').'.taxable)) FROM '.$this->db->dbprefix('invoice_items').' WHERE '.$this->db->dbprefix('invoice_items').'.invoice_id='.$invoice_id.') AS total_tax2', false);
        $this->db->select('(SELECT SUM('.$this->db->dbprefix('invoice_items').'.amount * '.$this->db->dbprefix('invoice_items').'.quantity + ROUND(('.$this->db->dbprefix('invoice_items').'.amount * '.$this->db->dbprefix('invoice_items').'.quantity * ('.$this->db->dbprefix('invoices').'.tax1_rate/100 + '.$this->db->dbprefix('invoices').'.tax2_rate/100) * '.$this->db->dbprefix('invoice_items').'.taxable), 2)) FROM '.$this->db->dbprefix('invoice_items').' WHERE '.$this->db->dbprefix('invoice_items').'.invoice_id='.$invoice_id.') AS total_with_tax', false);

        $this->db->join('clients', 'invoices.client_id = clients.id');
        $this->db->join('invoice_items', 'invoices.id = invoice_items.invoice_id', 'left');
        $this->db->join('invoice_payments', 'invoices.id = invoice_payments.invoice_id', 'left');
        $this->db->groupby('invoices.id');
        $this->db->where('invoices.id', $invoice_id);

        return $this->db->get('invoices');
    }

    // --------------------------------------------------------------------

    public function build_short_descriptions()
    {
        $limit = ($this->config->item('short_description_characters') != '') ? $this->config->item('short_description_characters') : 50;

        $short_descriptions = [];

        $this->db->select('invoice_id, work_description', false);
        $this->db->group_by('invoice_id');

        foreach ($this->db->get('invoice_items')->result() as $short_desc) {
            $short_descriptions[$short_desc->invoice_id] = ($limit == 0) ? '' : '['.character_limiter($short_desc->work_description, $limit).']';
        }

        return $short_descriptions;
    }

    // --------------------------------------------------------------------

    public function getInvoiceItems($invoice_id)
    {
        $this->db->where('invoice_id', $invoice_id);
        $this->db->order_by('id', 'ASC');

        $items = $this->db->get('invoice_items');

        if ($items->num_rows() > 0) {
            return $items;
        } else {
            return false;
        }
    }

    // --------------------------------------------------------------------

    public function getInvoiceHistory($invoice_id)
    {
        $this->db->where('invoice_histories.invoice_id', $invoice_id);
        $this->db->orderby('date_sent');

        return $this->db->get('invoice_histories');
    }

    // --------------------------------------------------------------------

    public function getInvoicePaymentHistory($invoice_id)
    {
        $this->db->where('invoice_id', $invoice_id);
        $this->db->orderby('date_paid');

        return $this->db->get('invoice_payments');
    }

    // --------------------------------------------------------------------

    public function getInvoices($status, $days_payment_due = 30, $offset = 0, $limit = 100)
    {
        return $this->_getInvoices(false, false, $status, $days_payment_due, $offset, $limit);
    }

    // --------------------------------------------------------------------

    /**
     * @param string $status
     * @param string $client_id
     */
    public function getInvoicesAJAX($status, $client_id, $days_payment_due = 30)
    {
        return $this->_getInvoices(false, $client_id, $status, $days_payment_due);
    }

    // --------------------------------------------------------------------

    /**
     * @param bool         $invoice_id
     * @param false|string $client_id
     */
    public function _getInvoices($invoice_id, $client_id, $status, $days_payment_due = 30, $offset = 0, $limit = 100)
    {
        // check for any invoices first
        if ($this->db->count_all_results('invoices') < 1) {
            return false;
        }

        if (is_numeric($invoice_id)) {
            $this->db->where('invoices.id', $invoice_id);
        }

        if (is_numeric($client_id)) {
            $this->db->where('client_id', $client_id);
        } else {
            $this->db->where('client_id IS NOT NULL');
        }

        if ($status == 'overdue') {
            $this->db->having("daysOverdue <= -$days_payment_due AND (ROUND(amount_paid, 2) < ROUND(subtotal, 2) OR amount_paid is null)", '', false);
        } elseif ($status == 'open') {
            $this->db->having('(ROUND(amount_paid, 2) < ROUND(subtotal, 2) or amount_paid is null)', '', false);
        } elseif ($status == 'closed') {
            $this->db->having('ROUND(amount_paid, 2) >= ROUND(subtotal, 2)', '', false);
        }

        $this->db->select('invoices.*, clients.name');
        $this->db->select('(SELECT SUM(amount_paid) FROM '.$this->db->dbprefix('invoice_payments').' WHERE invoice_id='.$this->db->dbprefix('invoices').'.id) AS amount_paid', false);
        $this->db->select('TO_DAYS('.$this->db->dbprefix('invoices').'.dateIssued) - TO_DAYS(curdate()) AS daysOverdue', false);
        $this->db->select('ROUND((SELECT SUM('.$this->db->dbprefix('invoice_items').'.amount * '.$this->db->dbprefix('invoice_items').'.quantity + ('.$this->db->dbprefix('invoice_items').'.amount * '.$this->db->dbprefix('invoice_items').'.quantity * ('.$this->db->dbprefix('invoices').'.tax1_rate/100 + '.$this->db->dbprefix('invoices').'.tax2_rate/100) * '.$this->db->dbprefix('invoice_items').'.taxable)) FROM '.$this->db->dbprefix('invoice_items').' WHERE '.$this->db->dbprefix('invoice_items').'.invoice_id='.$this->db->dbprefix('invoices').'.id), 2) AS subtotal', false);

        $this->db->join('clients', 'invoices.client_id = clients.id');
        $this->db->join('invoice_items', 'invoices.id = invoice_items.invoice_id', 'left');
        $this->db->join('invoice_payments', 'invoices.id = invoice_payments.invoice_id', 'left');

        $this->db->order_by('dateIssued desc, invoice_number desc');
        $this->db->groupby('invoices.id');
        $this->db->offset($offset);
        $this->db->limit($limit);

        return $this->db->get('invoices');
    }

    // --------------------------------------------------------------------

    public function lastInvoiceNumber($client_id)
    {
        if ($this->config->item('unique_invoice_per_client') === true) {
            $this->db->where('client_id', $client_id);
        }

        $this->db->where('invoice_number != ""');
        $this->db->orderby('id', 'desc');
        $this->db->limit(1);

        $query = $this->db->get('invoices');

        if ($query->num_rows() > 0) {
            return $query->row()->invoice_number;
        } else {
            return '0';
        }
    }

    // --------------------------------------------------------------------

    public function uniqueInvoiceNumber($invoice_number)
    {
        $this->db->where('invoice_number', $invoice_number);

        $query = $this->db->get('invoices');

        $num_rows = $query->num_rows();

        if ($num_rows == 0) {
            return true;
        } else {
            return false;
        }
    }

    // --------------------------------------------------------------------

    public function uniqueInvoiceNumberEdit($invoice_number, $invoice_id)
    {
        $this->db->where('invoice_number', $invoice_number);
        $this->db->where('id != ', $invoice_id);
        $query = $this->db->get('invoices');

        $num_rows = $query->num_rows();

        if ($num_rows == 0) {
            return true;
        } else {
            return false;
        }
    }
}
