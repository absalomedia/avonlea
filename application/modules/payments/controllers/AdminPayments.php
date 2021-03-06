<?php

namespace Avonlea\Controller;

/**
 * AdminPayments Class.
 *
 * @category    AdminPayments
 *
 * @author      Absalom Media
 *
 * @link        http://avonlea.absalom.net.au
 */
class AdminPayments extends Admin
{
    public function index()
    {
        \CI::auth()->checkAccess('Admin', true);

        \CI::lang()->load('settings');
        \CI::load()->helper('inflector');

        global $paymentModules;

        $data['payment_modules'] = $paymentModules;
        $data['enabled_modules'] = \CI::Settings()->getSettings('payment_modules');

        $data['page_title'] = lang('common_payment_modules');
        $this->view('payment_index', $data);
    }
}
