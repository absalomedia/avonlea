<?php

namespace Avonlea\Controller;

/**
 * AdminDashboard Class.
 *
 * @category    AdminDashboard
 *
 * @author      Absalom Media
 *
 * @link        http://avonlea.absalom.net.au
 */
class AdminDashboard extends Admin
{
    public function __construct()
    {
        parent::__construct();

        if (\CI::auth()->checkAccess('Orders')) {
            redirect(config_item('admin_folder').'/orders');
        }

        \CI::load()->model('Orders');
        \CI::load()->model('Customers');
        \CI::load()->helper('date');
        \CI::lang()->load('dashboard');
    }

    public function index()
    {
        //check to see if shipping and payment modules are installed
        $data['payment_module_installed'] = (bool) count(\CI::Settings()->getSettings('payment_modules'));
        $data['shipping_module_installed'] = (bool) count(\CI::Settings()->getSettings('shipping_modules'));

        $data['page_title'] = lang('dashboard');

        // get 5 latest orders
        $data['orders'] = \CI::Orders()->getOrders(false, 'ordered_on', 'DESC', 5);

        // get 5 latest customers
        $data['customers'] = \CI::Customers()->getCustomers(5);

        $this->view('dashboard', $data);
    }
}
