<?php

namespace Avonlea\Controller;

/**
 * AdminCod Class.
 *
 * @category    AdminCod
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
        \CI::lang()->load('cod');
    }

    //back end installation functions
    public function install()
    {
        //set a default blank setting for flatrate shipping
        \CI::Settings()->saveSettings('payment_modules', ['cod' => '1']);
        \CI::Settings()->saveSettings('cod', ['enabled' => '1']);

        redirect('admin/payments');
    }

    public function uninstall()
    {
        \CI::Settings()->delete_setting('payment_modules', 'cod');
        \CI::Settings()->deleteSettings('cod');
        redirect('admin/payments');
    }

    //admin end form and check functions
    public function form()
    {
        //this same function processes the form
        \CI::load()->helper('form');
        \CI::load()->library('form_validation');

        \CI::form_validation()->set_rules('enabled', 'lang:enabled', 'trim|numeric');

        if (\CI::form_validation()->run() === false) {
            $settings = \CI::Settings()->get_settings('cod');
            $enabled = $settings['enabled'];

            $this->view('cod_form', ['enabled' => $enabled]);
        } else {
            \CI::Settings()->saveSettings('cod', ['enabled' => $_POST['enabled']]);
            redirect('admin/payments');
        }
    }
}
