<?php namespace Avonlea\Controller;

/**
 * AdminReports Class
 *
 * @package     Avonlea
 * @subpackage  Controllers
 * @category    AdminReports
 * @author      Absalom Media
 * @link        http://Avonleadv.com
 */

class AdminReports extends Admin
{

    public $customer_id = false;

    public function __construct()
    {
        parent::__construct();
        \CI::auth()->checkAccess('Admin', true);
        \CI::load()->model(['Orders', 'Search']);
        \CI::load()->helper(array('formatting'));
        \CI::lang()->load('reports');
    }

    public function index()
    {
        $data['page_title'] = lang('reports');
        $data['years'] = \CI::Orders()->getSalesYears();
        $this->view('reports', $data);
    }

    public function best_sellers()
    {
        $start = \CI::input()->post('start');
        $end = \CI::input()->post('end');
        $data['best_sellers'] = \CI::Orders()->getBestSellers($start, $end);

        $this->partial('reports/best_sellers', $data);
    }

    public function sales()
    {
        $data['year'] = \CI::input()->post('year');
        $data['orders'] = \CI::Orders()->getGrossMonthlySales($data['year']);

        $this->partial('reports/sales', $data);
    }
}
