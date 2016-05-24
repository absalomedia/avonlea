<?php

$routes[] = ['GET|POST', '/admin/flat-rate/form', 'Avonlea\Controller\AdminFlatRate#form'];
$routes[] = ['GET|POST', '/admin/flat-rate/install', 'Avonlea\Controller\AdminFlatRate#install'];
$routes[] = ['GET|POST', '/admin/flat-rate/uninstall', 'Avonlea\Controller\AdminFlatRate#uninstall'];

$shippingModules[] = ['name'=>'Flat Rate', 'key'=>'flat-rate', 'class'=>'FlatRate'];
