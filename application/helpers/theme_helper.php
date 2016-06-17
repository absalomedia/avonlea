<?php

include 'crunch.php';
include 'Parsedown.php';
include 'content_filter.php';

function category_loop($parent = 0, $ulattribs = false, $ul = true)
{
    $cats = CI::Categories()->getCategoryTier();

    $items = false;
    if (isset($cats[$parent])) {
        $items = $cats[$parent];
    }

    if ($items) {
        echo ($ul) ? '<ul '.$ulattribs.'>' : '';
        foreach ($items as $item) {
            $selected = (CI::uri()->segment(2) === $item->slug) ? 'class="selected"' : '';

            //add the chevron if this has a drop menu
            $name = $item->name;
            if (CI::Categories()->tier($item->id)) {
                $name .= ' <i class="fa fa-chevron-down dropdown" aria-hidden="true"></i>';
            }

            $anchor = anchor('category/'.$item->slug, $name, $selected);

            echo '<li>'.$anchor;
            category_loop($item->id);
            echo '</li>';
        }
        echo ($ul) ? '</ul>' : '';
    }
}

function pageLooper($parent = 0, $ulattribs = false, $ul = true)
{
    $pages = CI::Pages()->getPagesTier();

    $items = false;
    if (isset($pages[$parent])) {
        $items = $pages[$parent];
    }

    if ($items) {
        echo ($ul) ? '<ul '.$ulattribs.'>' : '';
        foreach ($items as $item) {
            echo '<li>';
            $chevron = ' <i class="fa fa-chevron-down dropdown" aria-hidden="true"></i>';

            if ($item->slug === '') {
                //add the chevron if this has a drop menu
                $name = $item->title;
                if (isset($pages[$item->id])) {
                    $name .= $chevron;
                }

                $target = ($item->new_window) ? ' target="_blank"' : '';
                $anchor = '<a href="'.$item->url.'"'.$target.'>'.$name.'</a>';
            } else {
                //add the chevron if this has a drop menu
                $name = $item->menu_title;
                if (isset($pages[$item->id])) {
                    $name .= $chevron;
                }
                $selected = (CI::uri()->segment(2) === $item->slug) ? 'class="selected"' : '';
                $anchor = anchor('page/'.$item->slug, $name, $selected);
            }

            echo $anchor;
            pageLooper($item->id);
            echo '</li>';
        }
        echo ($ul) ? '</ul>' : '';
    }
}
