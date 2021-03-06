<?php

class Pages extends CI_Model
{
    public $tiered;

    public function __construct()
    {
        parent::__construct();
        $this->tiered = [];
        $this->getPagesTier();
    }

    /********************************************************************
    Page functions
     ********************************************************************/
    public function get_pages($parent = 0)
    {
        CI::db()->order_by('sequence', 'ASC');
        CI::db()->where('parent_id', $parent);
        $result = CI::db()->get('pages')->result();

        $return = [];
        foreach ($result as $page) {

            // Set a class to active, so we can highlight our current page
            if ($this->uri->segment(1) === $page->slug) {
                $page->active = true;
            } else {
                $page->active = false;
            }

            $return[$page->id] = $page;
            $return[$page->id]->children = $this->get_pages($page->id);
        }

        return $return;
    }

    public function getPagesTier()
    {
        if (!empty($this->tiered)) {
            return $this->tiered;
        }

        CI::db()->order_by('sequence');
        CI::db()->order_by('title', 'ASC');
        $pages = CI::db()->get('pages')->result();

        $results = [];
        $results['all'] = [];
        foreach ($pages as $page) {

            // Set a class to active, so we can highlight our current page
            if ($this->uri->segment(2) === $page->slug && $this->uri->segment(1) === 'page') {
                $page->active = true;
            } else {
                $page->active = false;
            }
            $results['all'][$page->id] = $page;
            $results[$page->parent_id][$page->id] = $page;
        }

        $this->tiered = $results;

        return $results;
    }

    public function find($optn)
    {
        return CI::db()->where('id', $optn)->get('pages')->row();
    }

    public function slug($slug)
    {
        return  CI::db()->where('slug', $slug)->get('pages')->row();
    }

    public function get_slug($optn)
    {
        $page = $this->get_page($optn);
        if ($page) {
            return $page->slug;
        }
    }

    public function save($data)
    {
        if ($data['id']) {
            CI::db()->where('id', $data['id']);
            CI::db()->update('pages', $data);

            return $data['id'];
        } else {
            CI::db()->insert('pages', $data);

            return CI::db()->insert_id();
        }
    }

    public function delete_page($optn)
    {
        //delete the page
        CI::db()->where('id', $optn);
        CI::db()->delete('pages');
    }

    public function validateSlug($slug, $optn = false, $counter = false)
    {
        CI::db()->select('slug');
        CI::db()->from('pages');
        CI::db()->where('slug', $slug.$counter);
        if ($optn) {
            CI::db()->where('id !=', $optn);
        }
        $count = CI::db()->count_all_results();

        if ($count > 0) {
            if (!$counter) {
                $counter = 1;
            } else {
                $counter++;
            }

            return $this->validateSlug($slug, $optn, $counter);
        } else {
            return $slug.$counter;
        }
    }
}
