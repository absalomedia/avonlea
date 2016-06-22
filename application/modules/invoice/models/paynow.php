<?php

class PayNow extends Controller
{
    public function __construct()
    {
        parent::Controller();
        $this->load->model('invoices_model');
        $this->load->model('settings_model');
    }

    // --------------------------------------------------------------------

    public function index()
    {
        redirect('');
    }

    // --------------------------------------------------------------------

    public function getcurrency()
    {
        if (\CI::Settings()->getSettings('currency_type')) {
            return \CI::Settings()->getSettings('currency_type');
        } else {
            $cur_symbol = \CI::Settings()->getSettings('currency_symbol');

            if ($cur_symbol == htmlentities('$')) {
                return 'USD';
            } elseif ($cur_symbol == '€') {
                return 'EUR';
            } elseif ($cur_symbol == '£') {
                return 'GBP';
            } elseif ($cur_symbol == '¥') {
                return 'JPY';
            }
        }
    }

    // --------------------------------------------------------------------

    public function googlecheckout($optn)
    {
        if (!$optn) {
            redirect('');
        }

        $data['row'] = \CI::Invoices()->getSingleInvoice($optn)->row();

        if (!$data['row']) {
            redirect('');
        }

        echo '<html>
            <head>
                <title>Redirecting to Google Checkout ...</title>
            </head>
            <body>
                <h1 style="text-align: center">Redirecting to Google Checkout ...</h1>
				<form action="https://checkout.google.com/api/checkout/v2/checkoutForm/Merchant/'.\CI::Settings()->getSettings('google_merchant_id').'" id="BB_BuyButtonForm" method="post" name="BB_BuyButtonForm">
					<input name="item_name_1" type="hidden" value="Invoice '.$data['row']->invoice_number.'" />
                    <input name="item_description_1" type="hidden" value="" />
                    <input name="item_quantity_1" type="hidden" value="1" />
					<input name="item_price_1" type="hidden" value="'.($data['row']->total_with_tax - $data['row']->amount_paid).'" />
					<input name="item_currency_1" type="hidden" value="'.$this->getcurrency().'" />
                    <input name="_charset_" type="hidden" value="utf-8" />
                </form>
                <script>document.forms["BB_BuyButtonForm"].submit();</script>
            </body>
		</html>';
    }

    // --------------------------------------------------------------------

    public function paypal($optn)
    {
        if (!$optn) {
            redirect('');
        }

        $data['row'] = \CI::Invoices()->getSingleInvoice($optn)->row();

        if (!$data['row']) {
            redirect('');
        }

        echo '<html>
            <head>
                <title>Redirecting to PayPal ...</title>
            </head>
            <body>
                <h1 style="text-align: center">Redirecting to PayPal ...</h1>
                <form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="paypalredirect">
					<input type="hidden" name="business" value="'.\CI::Settings()->getSettings('paypal_email').'" />
                    <input type="hidden" name="cmd" value="_xclick" />
					<input type="hidden" name="item_name" value="Invoice '.$data['row']->invoice_number.'" /> 
					<input type="hidden" name="amount" value="'.($data['row']->total_with_tax - $data['row']->amount_paid).'" />
					<input type="hidden" name="currency_code" value="'.$this->getcurrency().'" />
                </form>
                <script>document.forms["paypalredirect"].submit();</script>
            </body>
		</html>';
    }
}
