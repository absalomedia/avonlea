<?php

$routes[] = ['GET|POST', '/admin/users', 'Avonlea\Controller\AdminUsers#index'];
$routes[] = ['GET|POST', '/admin/users/form/[i:id]?', 'Avonlea\Controller\AdminUsers#form'];
$routes[] = ['GET|POST', '/admin/users/delete/[i:id]', 'Avonlea\Controller\AdminUsers#delete'];
