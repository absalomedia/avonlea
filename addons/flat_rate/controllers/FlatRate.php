<?php namespace Avonlea\Controller;

/**
 * FlatRate Class
 *
 * @package     Avonlea
 * @subpackage  Controllers
 * @category    FlatRate
 * @author      Clear Sky Designs
 * @link        http://Avonleadv.com
 */

class FlatRate extends Front
{


    public function __construct()
    {
        parent::__construct();
        \CI::load()->model(array('Locations'));
        $this->customer = \CI::Login()->customer();
    }

    public function rates()
    {
        $settings = \CI::Settings()->get_settings('FlatRate');
        
        if (isset($settings['enabled']) && (bool)$settings['enabled']) {
            return ['Flat Rate'=> $settings['rate']];
        } else {
            return [];
        }
    }
}
