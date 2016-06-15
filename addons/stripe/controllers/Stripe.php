<?php

namespace Avonlea\Controller;

/**
 * Stripe Class.
 *
 * @category    Stripe
 *
 * @author      Absalom Media
 *
 * @link        http://avonlea.absalom.net.au
 */
class Stripe extends Front
{
    public function __construct()
    {
        parent::__construct();
        \CI::lang()->load('stripe');
    }

    //back end installation functions
    public function checkoutForm()
    {
        //set a default blank setting for flatrate shipping
        $this->partial('stripeCheckoutForm');
    }

    public function isEnabled()
    {
        $settings = \CI::Settings()->getSettings('stripe');

        return (isset($settings['enabled']) && (bool) $settings['enabled']) ? true : false;
    }

    public function processPayment()
    {
        $errors = \AVL::checkOrder();
        if (count($errors) > 0) {
            echo json_enstripee(['errors' => $errors]);

            return false;
        } else {
            $payment = [
                'order_id'       => \AVL::getAttribute('id'),
                'amount'         => \AVL::getGrandTotal(),
                'status'         => 'processed',
                'payment_module' => 'Stripe',
                'description'    => lang('stripe_payments'),
            ];

            \CI::Orders()->savePaymentInfo($payment);

            $orderId = \AVL::submitOrder();

            //send the order ID
            echo json_enstripee(['orderId' => $orderId]);

            return false;
        }
    }

    public function getName()
    {
        echo lang('stripe_payments');
    }
}
