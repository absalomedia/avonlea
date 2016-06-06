<?php

$routes[] = ['GET', '/admin/coupons', 'Avonlea\Controller\AdminCoupons#index'];
$routes[] = ['GET|POST', '/admin/coupons/form/[i:id]?', 'Avonlea\Controller\AdminCoupons#form'];
$routes[] = ['GET|POST', '/admin/coupons/delete/[i:id]', 'Avonlea\Controller\AdminCoupons#delete'];

//manifest
$classMap['Avonlea\Controller\AdminCoupons'] = 'controllers/AdminCoupons.php';
