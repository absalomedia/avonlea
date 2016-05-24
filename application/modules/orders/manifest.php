<?php

$routes[] = ['GET|POST', '/admin/orders/form/[i:id]?', 'Avonlea\Controller\AdminOrders#form'];
$routes[] = ['GET|POST', '/admin/orders/export', 'Avonlea\Controller\AdminOrders#export'];
$routes[] = ['GET|POST', '/admin/orders/bulk_delete', 'Avonlea\Controller\AdminOrders#bulk_delete'];
$routes[] = ['GET|POST', '/admin/orders/order/[:orderNumber]', 'Avonlea\Controller\AdminOrders#order'];
$routes[] = ['GET|POST', '/admin/orders/sendNotification/[:orderNumber]', 'Avonlea\Controller\AdminOrders#sendNotification'];
$routes[] = ['GET|POST', '/admin/orders/packing_slip/[:orderNumber]', 'Avonlea\Controller\AdminOrders#packing_slip'];
$routes[] = ['GET|POST', '/admin/orders/edit_status', 'Avonlea\Controller\AdminOrders#edit_status'];
$routes[] = ['GET|POST', '/admin/orders/delete/[i:id]', 'Avonlea\Controller\AdminOrders#delete'];
$routes[] = ['GET|POST', '/admin/orders', 'Avonlea\Controller\AdminOrders#index'];
$routes[] = ['GET|POST', '/admin/orders/index/[:orderBy]?/[:orderDir]?/[:code]?/[i:page]?', 'Avonlea\Controller\AdminOrders#index'];
$routes[] = ['GET|POST', '/digital-products/download/[i:fileId]/[i:orderId]', 'Avonlea\Controller\DigitalProducts#download'];
