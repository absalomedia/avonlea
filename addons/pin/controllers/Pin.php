<?php

namespace Avonlea\Controller;

/**
 * Pin Class.
 *
 * @category    Pin
 *
 * @author      Absalom Media
 *
 * @link        http://avonlea.absalom.net.au
 */
class Pin extends Front
{
    public function __construct()
    {
        parent::__construct();
        \CI::lang()->load('pin');
    }

    //back end installation functions
    public function checkoutForm()
    {
        //set a default blank setting for flatrate shipping
        $this->partial('pinCheckoutForm');
    }

    public function isEnabled()
    {
        $settings = \CI::Settings()->getSettings('pin');

        return (isset($settings['enabled']) && (bool) $settings['enabled']) ? true : false;
    }

    public function processPayment()
    {
        $errors = \AVL::checkOrder();
        if (count($errors) > 0) {
            echo json_encode(['errors' => $errors]);

            return false;
        } else {
            $payment = [
                'order_id'       => \AVL::getAttribute('id'),
                'amount'         => \AVL::getGrandTotal(),
                'status'         => 'processed',
                'payment_module' => 'Pin',
                'description'    => lang('pin_payments'),
            ];

            \CI::Orders()->savePaymentInfo($payment);

            $orderId = \AVL::submitOrder();

            //send the order ID
            echo json_encode(['orderId' => $orderId]);

            return false;
        }
    }

    public function getName()
    {
        echo lang('pin_payments');
    }
}
