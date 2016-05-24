<?php

$routes[] = ['GET|POST', '/admin/pin/form', 'Avonlea\Controller\AdminPin#form'];
$routes[] = ['GET|POST', '/admin/pin/install', 'Avonlea\Controller\AdminPin#install'];
$routes[] = ['GET|POST', '/admin/pin/uninstall', 'Avonlea\Controller\AdminPin#uninstall'];
$routes[] = ['GET|POST', '/pin/process-payment', 'Avonlea\Controller\Pin#processPayment'];

$paymentModules[] = ['name'=>'Pin Payments', 'key'=>'pin', 'class'=>'Pin'];
