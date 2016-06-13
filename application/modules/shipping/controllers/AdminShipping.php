<?php

namespace Avonlea\Controller;

/**
 * AdminShipping Class.
 *
 * @category    AdminShipping
 *
 * @author      Absalom Media
 *
 * @link        http://avonlea.absalom.net.au
 */
class AdminShipping extends Admin
{
    public function index()
    {
        \CI::auth()->checkAccess('Admin', true);

        \CI::lang()->load('settings');
        \CI::load()->helper('inflector');

        global $shippingModules;

        $data['shipping_modules'] = $shippingModules;
        $data['enabled_modules'] = \CI::Settings()->getSettings('shipping_modules');

        $data['page_title'] = lang('common_shipping_modules');
        $this->view('shipping_index', $data);
    }
}
