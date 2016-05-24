<?php namespace Avonlea;

use \Avonlea\Libraries\View as View;

class Controller
{

    public $views;

    public function __construct()
    {
        \CI::load()->helper('form');
        \CI::load()->library('breadcrumbs');
        
        $this->views = View::getInstance();
    }
}
