<?php

namespace Models\Reports;

class Data extends CI_Model
{
    public function __construct()
    {
        return parent::__construct();
    }

    public function getDetailedData($start_date, $end_date)
    {
        $this->db->select('name');
        $this->db->select_sum('amount * quantity', 'amount', false);
        $this->db->select('SUM('.$this->db->dbprefix('invoice_items').'.amount*'.$this->db->dbprefix('invoices').'.tax1_rate/100 * '.$this->db->dbprefix('invoice_items').'.quantity) as tax1_collected', false);
        $this->db->select('SUM('.$this->db->dbprefix('invoice_items').'.amount*'.$this->db->dbprefix('invoices').'.tax2_rate/100 * '.$this->db->dbprefix('invoice_items').'.quantity) as tax2_collected', false);
        $this->db->join('invoices', 'invoices.client_id = clients.id');
        $this->db->join('invoice_items', 'invoices.id = invoice_items.invoice_id');
        $this->db->where('dateIssued >= "'.$start_date.'" and dateIssued <= "'.$end_date.'"');
        $this->db->orderby('clients.name');
        $this->db->groupby('name');

        return $this->db->get('clients');
    }

    // --------------------------------------------------------------------

    public function getSummaryData($start_date, $end_date)
    {
        $this->db->select_sum('amount * quantity', 'amount');
        $this->db->select('SUM(('.$this->db->dbprefix('invoice_items').'.amount*'.$this->db->dbprefix('invoice_items').'.quantity)*'.$this->db->dbprefix('invoices').'.tax1_rate/100) AS tax1_collected', false);
        $this->db->select('SUM(('.$this->db->dbprefix('invoice_items').'.amount*'.$this->db->dbprefix('invoice_items').'.quantity)*'.$this->db->dbprefix('invoices').'.tax2_rate/100) AS tax2_collected', false);
        $this->db->join('invoices', 'invoices.client_id = clients.id');
        $this->db->join('invoice_items', 'invoices.id = invoice_items.invoice_id');
        $this->db->where('dateIssued >= ', $start_date);
        $this->db->where('dateIssued <= ', $end_date);

        return $this->db->get('clients')->row();
    }

    // --------------------------------------------------------------------

    public function getInvoiceDateRange($start_date, $end_date)
    {
        $this->db->distinct();
        $this->db->select('invoices.id');
        $this->db->join('clients', 'invoices.client_id = clients.id');
        $this->db->join('invoice_items', 'invoices.id = invoice_items.invoice_id');
        $this->db->where("dateIssued >= '$start_date'");
        $this->db->where("dateIssued <= '$end_date'");
        $this->db->orderby('dateIssued desc, invoice_number desc');

        return $this->db->get('invoices');
    }
}
