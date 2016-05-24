<?php

$routes[] = ['GET|POST', '/admin/digital_products/form/[i:id]?', 'Avonlea\Controller\AdminDigitalProducts#form'];
$routes[] = ['GET|POST', '/admin/digital_products/delete/[i:id]', 'Avonlea\Controller\AdminDigitalProducts#delete'];
$routes[] = ['GET|POST', '/admin/digital_products', 'Avonlea\Controller\AdminDigitalProducts#index'];

//manifest
$classMap['Avonlea\Controller\AdminDigitalProducts'] = 'controllers/AdminDigitalProducts.php';
