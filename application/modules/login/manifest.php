<?php

$routes[] = ['GET|POST', '/admin/login', 'Avonlea\Controller\AdminLogin#login'];
$routes[] = ['GET|POST', '/admin/logout', 'Avonlea\Controller\AdminLogin#logout'];
$routes[] = ['GET|POST', '/login/[:redirect]?', 'Avonlea\Controller\Login#login'];
$routes[] = ['GET|POST', '/logout', 'Avonlea\Controller\Login#logout'];
$routes[] = ['GET|POST', '/forgot-password', 'Avonlea\Controller\Login#forgotPassword'];
$routes[] = ['GET|POST', '/admin/forgot-password', 'Avonlea\Controller\AdminLogin#forgotPassword'];
$routes[] = ['GET|POST', '/register', 'Avonlea\Controller\Login#register'];
