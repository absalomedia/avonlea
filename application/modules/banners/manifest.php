<?php

$routes[] = ['GET', '/admin/banners', 'Avonlea\Controller\AdminBanners#index'];
$routes[] = ['GET|POST', '/admin/banners/banner_collection_form/[i:id]?', 'Avonlea\Controller\AdminBanners#banner_collection_form'];
$routes[] = ['GET|POST', '/admin/banners/delete_banner_collection/[i:id]', 'Avonlea\Controller\AdminBanners#delete_banner_collection'];
$routes[] = ['GET|POST', '/admin/banners/banner_collection/[i:id]', 'Avonlea\Controller\AdminBanners#banner_collection'];
$routes[] = ['GET|POST', '/admin/banners/banner_form/[i:banner_collection_id]/[i:id]?', 'Avonlea\Controller\AdminBanners#banner_form'];
$routes[] = ['GET|POST', '/admin/banners/delete_banner/[i:id]', 'Avonlea\Controller\AdminBanners#delete_banner'];
$routes[] = ['GET|POST', '/admin/banners/organize', 'Avonlea\Controller\AdminBanners#organize'];

$themeShortcodes[] = ['shortcode' => 'banner', 'method' => ['Banners', 'show_collection']];
