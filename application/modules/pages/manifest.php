<?php

$routes[] = ['GET', '/admin/pages', 'Avonlea\Controller\AdminPages#index'];
$routes[] = ['GET|POST', '/admin/pages/form/[i:id]?', 'Avonlea\Controller\AdminPages#form'];
$routes[] = ['GET|POST', '/admin/pages/link_form/[i:id]?', 'Avonlea\Controller\AdminPages#link_form'];
$routes[] = ['GET|POST', '/admin/pages/delete/[i:id]', 'Avonlea\Controller\AdminPages#delete'];
$routes[] = ['GET|POST', '/page/[:slug]', 'Avonlea\Controller\Page#index'];
