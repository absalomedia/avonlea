<?php

$routes[] = ['GET|POST', '/admin/products/product_autocomplete', 'Avonlea\Controller\AdminProducts#product_autocomplete'];
$routes[] = ['GET|POST', '/admin/products/bulk_save', 'Avonlea\Controller\AdminProducts#bulk_save'];
$routes[] = ['GET|POST', '/admin/products/product_image_form', 'Avonlea\Controller\AdminProducts#product_image_form'];
$routes[] = ['GET|POST', '/admin/products/product_image_upload', 'Avonlea\Controller\AdminProducts#product_image_upload'];
$routes[] = ['GET|POST', '/admin/products/form/[i:id]?/[i:copy]?', 'Avonlea\Controller\AdminProducts#form'];
$routes[] = ['GET|POST', '/admin/products/gift-card-form/[i:id]?/[i:copy]?', 'Avonlea\Controller\AdminProducts#giftCardForm'];
$routes[] = ['GET|POST', '/admin/products/delete/[i:id]', 'Avonlea\Controller\AdminProducts#delete'];
$routes[] = ['GET|POST', '/admin/products/[i:rows]?/[:order_by]?/[:sort_order]?/[:code]?/[i:page]?', 'Avonlea\Controller\AdminProducts#index'];
$routes[] = ['GET|POST', '/product/[:slug]', 'Avonlea\Controller\Product#index'];
