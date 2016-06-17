<?php

namespace Avonlea\Controller;

/**
 * AdminFlatRate Class.
 *
 * @category    AdminFlatRate
 *
 * @author      Absalom Media
 *
 * @link        http://avonlea.absalom.net.au
 */
class AdminFlatRate extends Admin
{
    public function __construct()
    {
        parent::__construct();
        \CI::auth()->checkAccess('Admin', true);
        \CI::lang()->load('flat_rate');
    }

    //back end installation functions
    public function install()
    {
        //set a default blank setting for flatrate shipping
        \CI::Settings()->saveSettings('shipping_modules', ['FlatRate' => '1']);
        \CI::Settings()->saveSettings('FlatRate', ['enabled' => '1', 'rate' => 0]);

        redirect('admin/shipping');
    }

    public function uninstall()
    {
        \CI::Settings()->deleteSetting('shipping_modules', 'FlatRate');
        \CI::Settings()->deleteSettings('FlatRate');
        redirect('admin/shipping');
    }

    //admin end form and check functions
    public function form()
    {
        //this same function processes the form
        \CI::load()->helper('form');
        \CI::load()->library('form_validation');

        \CI::form_validation()->set_rules('enabled', 'lang:enabled', 'trim|numeric');
        \CI::form_validation()->set_rules('rate', 'lang:rate', 'trim|floatval');

        if (\CI::form_validation()->run() === true) {
            \CI::Settings()->saveSettings('FlatRate', \CI::input()->post());
            redirect('admin/shipping');
        }
        $settings = \CI::Settings()->getSettings('FlatRate');
        $this->view('flat_rate_form', $settings);
    }
}
