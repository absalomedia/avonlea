<?php

$routes[] = ['GET|POST', '/admin/stripe/form', 'Avonlea\Controller\AdminStripe#form'];
$routes[] = ['GET|POST', '/admin/stripe/install', 'Avonlea\Controller\AdminStripe#install'];
$routes[] = ['GET|POST', '/admin/stripe/uninstall', 'Avonlea\Controller\AdminStripe#uninstall'];
$routes[] = ['GET|POST', '/stripe/process-payment', 'Avonlea\Controller\Stripe#processPayment'];

$paymentModules[] = ['name' => 'Stripe', 'key' => 'stripe', 'class' => 'Stripe'];
