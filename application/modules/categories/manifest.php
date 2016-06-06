<?php

$routes[] = ['GET', '/admin/categories', 'Avonlea\Controller\AdminCategories#index'];
$routes[] = ['GET|POST', '/admin/categories/form/[i:id]?', 'Avonlea\Controller\AdminCategories#form'];
$routes[] = ['GET|POST', '/admin/categories/delete/[i:id]', 'Avonlea\Controller\AdminCategories#delete'];
$routes[] = ['GET|POST', '/category/[:slug]/[:sort]?/[:dir]?/[:page]?', 'Avonlea\Controller\Category#index'];

$themeShortcodes[] = ['shortcode' => 'category', 'method' => ['Avonlea\Controller\Category', 'shortcode']];
