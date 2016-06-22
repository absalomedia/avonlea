<?php
/**
 * Breadcrumbs Class.
 *
 * @category    Breadcrumbs
 *
 * @author      Absalom Media
 *
 * @link        http://avonlea.absalom.net.au
 */
class Breadcrumbs
{
    public $breadcrumbs;

    public function __construct()
    {
        $this->breadcrumbs = [];
    }

    public function traceCategories($optn)
    {
        $category = CI::Categories()->find($optn);
        if ($category) {
            array_unshift($this->breadcrumbs, ['link' => site_url('category/'.$category->slug), 'name' => $category->name]);
            $this->traceCategories($category->parent_id);
        }
    }

    public function tracePages($optn)
    {
        if (isset($this->CI->pages['all'][$optn])) {
            $page = $this->CI->pages['all'][$optn];
            array_unshift($this->breadcrumbs, ['link' => site_url('page/'.$page->slug), 'name' => $page->title]);
            $this->tracePages($page->parent_id);
        }
    }

    public function generate()
    {
        $type = CI::uri()->segment(1);
        $slug = CI::uri()->segment(2);
        if (!$type || !$slug) {
            return; //return blank
        }
        if ($type === 'category') {
            $category = CI::Categories()->slug($slug);
            if (!$category) {
                return;
            }
            $this->traceCategories($category->id);
        } elseif ($type === 'product') {
            $product = CI::Products()->slug($slug);
            if (!$product) {
                return;
            }
            array_unshift($this->breadcrumbs, ['link' => site_url('product/'.$product->slug), 'name' => $product->name]);
            $this->traceCategories($product->primary_category);
        } elseif ($type === 'page') {
            $page = CI::Pages()->slug($slug);
            if (!$page) {
                return;
            }
            $this->tracePages($page->id);
        }

        echo Avonlea\Libraries\View::getInstance()->get('breadcrumbs', ['breadcrumbs' => $this->breadcrumbs]);
    }
}
