<?php

namespace Invoice;

class Invoicehistory extends CI_Model
{
    public function __construct()
    {
        return parent::__construct();
    }

    /*
   * Insert History / Notes
   *
   * @access  public
   * @param  int    Invoice Id
   * @param  str    Text for the history
   * @param  mixed  Whom the history was sent to
   * @param  int    Contact Type. 1 is for invoice email, 2 is for quote email, 3 is for admin note entry
   * @return  int    Invoice Id
   */
    public function insertHistoryNote($invoice_id, $history_body, $clientcontacts_id = '', $contact_type = 1)
    {
        $historyInfo = [
                'invoice_id'        => $invoice_id,
                'clientcontacts_id' => serialize($clientcontacts_id),
                'date_sent'         => date('Y-m-d'),
                'contact_type'      => $contact_type,
                'email_body'        => $history_body,
                ];

        $this->db->insert('invoice_histories', $historyInfo);

        return $invoice_id;
    }

    // --------------------------------------------------------------------

    public function insertHistoryEmailInvoice($id, $email_body, $recipient_names)
    {
        $this->insert_history_note($id, $email_body, $recipient_names, 1);
    }

    public function insertHistoryEmailQuote($id, $email_body, $recipient_names)
    {
        $this->insert_history_note($id, $email_body, $recipient_names, 2);
    }

    public function insertNote($invoice_id, $note)
    {
        $this->insert_history_note($invoice_id, $note, '', 3);
    }
}
