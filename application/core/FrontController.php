<?php

namespace Avonlea\Controller;

class Front extends \Avonlea\Controller
{
    public function __construct()
    {
        parent::__construct();

        //add the theme to the packages path
        \CI::load()->add_package_path(FCPATH.'themes/'.config_item('theme').'/');
        \CI::load()->model(['Pages', 'Login']);

        //load in some base information
        \CI::lang()->load('common');
        $this->pages = \CI::Pages()->getPagesTier();

        //see if the customer is logged in.
        //if the customer is not logged in, then we'll have a temporary guest customer created.
        $this->isLoggedIn = \CI::Login()->isLoggedIn();
    }

    /**
     * @param string $view
     */
    public function view($view, $vars = [], $string = false)
    {
        //pass in the controller so we can access the controllers variables
        //$vars['this'] = $this;

        if ($string) {
            $result = $this->views->get('header', $vars);
            $result .= $this->views->get($view, $vars);
            $result .= $this->views->get('footer', $vars);

            return $result;
        } else {
            $this->views->show('header', $vars);
            $this->views->show($view, $vars);
            $this->views->show('footer', $vars);
        }
    }

    /**
     * @param string $view
     */
    public function partial($view, $vars = [], $string = false)
    {
        //$vars['this'] = $this;

        if ($string) {
            return $this->views->get($view, $vars);
        } else {
            $this->views->show($view, $vars);
        }
    }
}
