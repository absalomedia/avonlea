<?php namespace Avonlea\Controller;

/**
 * AdminShipping Class
 *
 * @package     Avonlea
 * @subpackage  Controllers
 * @category    AdminShipping
 * @author      Absalom Media
 * @link        http://Avonleadv.com
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
