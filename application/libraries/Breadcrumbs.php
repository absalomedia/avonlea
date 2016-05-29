<?php
/**
 * Breadcrumbs Class
 *
 * @package     Avonlea
 * @subpackage  Libraries
 * @category    Breadcrumbs
 * @author      Absalom Media
 * @link        http://Avonleadv.com
 */

class Breadcrumbs
{
    public $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = [];
    }

    public function trace_categories($id)
    {
        $category = CI::Categories()->find($id);
        if ($category) {
            array_unshift($this->breadcrumbs, ['link'=>site_url('category/'.$category->slug), 'name'=>$category->name]);
            $this->trace_categories($category->parent_id);
        }
    }

    public function trace_pages($id)
    {
        if (isset($this->CI->pages['all'][$id])) {
            $page = $this->CI->pages['all'][$id];
            array_unshift($this->breadcrumbs, ['link'=>site_url('page/'.$page->slug), 'name'=>$page->title]);
            $this->trace_pages($page->parent_id);
        }
    }

    public function generate()
    {
        $type = CI::uri()->segment(1);
        $slug   = CI::uri()->segment(2);
        if (!$type || !$slug) {
            return; //return blank
        }
        if ($type == 'category') {
            $category = CI::Categories()->slug($slug);
            if (!$category) {
                return;
            }
            $this->trace_categories($category->id);
        } elseif ($type == 'product') {
            $product = CI::Products()->slug($slug);
            if (!$product) {
                return;
            }
            array_unshift($this->breadcrumbs, ['link'=>site_url('product/'.$product->slug), 'name'=>$product->name]);
            $this->trace_categories($product->primary_category);
        } elseif ($type == 'page') {
            $page = CI::Pages()->slug($slug);
            if (!$page) {
                return;
            }
            $this->trace_pages($page->id);
        }

        echo Avonlea\Libraries\View::getInstance()->get('breadcrumbs', ['breadcrumbs'=>$this->breadcrumbs]);
    }
}
