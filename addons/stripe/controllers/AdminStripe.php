<?php

namespace Avonlea\Controller;

/**
 * AdminStripe Class.
 *
 * @category    AdminStripe
 *
 * @author      Absalom Media
 *
 * @link        http://avonlea.absalom.net.au
 */
class AdminStripe extends Admin
{
    public function __construct()
    {
        parent::__construct();

        \CI::auth()->checkAccess('Admin', true);
        \CI::lang()->load('stripe');
    }

    //back end installation functions
    public function install()
    {
        //set a default blank setting for flatrate shipping
        \CI::Settings()->saveSettings('payment_modules', ['stripe' => '1']);
        \CI::Settings()->saveSettings('stripe', ['enabled' => '1']);

        redirect('admin/payments');
    }

    public function uninstall()
    {
        \CI::Settings()->deleteSetting('payment_modules', 'stripe');
        \CI::Settings()->deleteSettings('stripe');
        redirect('admin/payments');
    }

    //admin end form and check functions
    public function form()
    {
        //this same function processes the form
        \CI::load()->helper('form');
        \CI::load()->library('form_validation');

        \CI::form_validation()->set_rules('enabled', 'lang:enabled', 'trim|numeric');

        if (\CI::form_validation()->run() === true) {
            \CI::Settings()->saveSettings('stripe', ['enabled' =>  filter_input(INPUT_POST, 'enabled', FILTER_VALIDATE_INT)]);
            if (filter_input(INPUT_POST, 'enabled', FILTER_VALIDATE_INT)) {
                redirect('admin/payments');
            }
        }

        $settings = \CI::Settings()->getSettings('stripe');
        $enabled = (isset($settings['enabled']) ? $settings['enabled'] : null);
        $this->view('stripe_form', ['enabled' => $enabled]);
    }
}
