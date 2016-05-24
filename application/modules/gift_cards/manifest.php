<?php

$routes[] = ['GET|POST', '/admin/gift-cards/form', 'Avonlea\Controller\AdminGiftCards#form'];
$routes[] = ['GET|POST', '/admin/gift-cards/delete/[i:id]', 'Avonlea\Controller\AdminGiftCards#delete'];
$routes[] = ['GET|POST', '/admin/gift-cards/enable', 'Avonlea\Controller\AdminGiftCards#enable'];
$routes[] = ['GET|POST', '/admin/gift-cards/disable', 'Avonlea\Controller\AdminGiftCards#disable'];
$routes[] = ['GET|POST', '/admin/gift-cards/settings', 'Avonlea\Controller\AdminGiftCards#settings'];
$routes[] = ['GET|POST', '/admin/gift-cards', 'Avonlea\Controller\AdminGiftCards#index'];

//manifest
$classMap['Avonlea\Controller\AdminGiftCards'] = 'controllers/AdminGiftCards.php';
