<?php

$routes[] = ['GET|POST', '/admin/cod/form', 'Avonlea\Controller\AdminCod#form'];
$routes[] = ['GET|POST', '/admin/cod/install', 'Avonlea\Controller\AdminCod#install'];
$routes[] = ['GET|POST', '/admin/cod/uninstall', 'Avonlea\Controller\AdminCod#uninstall'];
$routes[] = ['GET|POST', '/cod/process-payment', 'Avonlea\Controller\Cod#processPayment'];

$paymentModules[] = ['name'=>'Charge on Delivery', 'key'=>'cod', 'class'=>'Cod'];
