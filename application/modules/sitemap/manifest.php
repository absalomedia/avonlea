<?php

$routes[] = ['GET|POST', '/admin/sitemap', 'Avonlea\Controller\AdminSitemap#index'];
$routes[] = ['GET|POST', '/admin/sitemap/new-sitemap', 'Avonlea\Controller\AdminSitemap#newSitemap'];
$routes[] = ['GET|POST', '/admin/sitemap/generate-products', 'Avonlea\Controller\AdminSitemap#generateProducts'];
$routes[] = ['GET|POST', '/admin/sitemap/generate-pages', 'Avonlea\Controller\AdminSitemap#generatePages'];
$routes[] = ['GET|POST', '/admin/sitemap/generate-categories', 'Avonlea\Controller\AdminSitemap#generateCategories'];
$routes[] = ['GET|POST', '/admin/sitemap/complete-sitemap', 'Avonlea\Controller\AdminSitemap#completeSitemap'];
