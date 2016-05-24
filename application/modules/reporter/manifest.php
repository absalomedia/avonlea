<?php

$routes[] = ['GET|POST', '/admin/reports', 'Avonlea\Controller\AdminReports#index'];
$routes[] = ['GET|POST', '/admin/reports/best_sellers', 'Avonlea\Controller\AdminReports#best_sellers'];
$routes[] = ['GET|POST', '/admin/reports/sales', 'Avonlea\Controller\AdminReports#sales'];
