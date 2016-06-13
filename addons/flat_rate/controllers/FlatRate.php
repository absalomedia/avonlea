<?php

namespace Avonlea\Controller;

/**
 * FlatRate Class.
 *
 * @category    FlatRate
 *
 * @author      Absalom Media
 *
 * @link        http://avonlea.absalom.net.au
 */
class FlatRate extends Front
{
    public function __construct()
    {
        parent::__construct();
        \CI::load()->model(['Locations']);
        $this->customer = \CI::Login()->customer();
    }

    public function rates()
    {
        $settings = \CI::Settings()->get_settings('FlatRate');

        if (isset($settings['enabled']) && (bool) $settings['enabled']) {
            return ['Flat Rate' => $settings['rate']];
        } else {
            return [];
        }
    }
}
