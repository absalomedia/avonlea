<?php


$routes[] = ['GET|POST', '/admin/customers/export', 'Avonlea\Controller\AdminCustomers#export'];
$routes[] = ['GET|POST', '/admin/customers/get_subscriber_list', 'Avonlea\Controller\AdminCustomers#getSubscriberList'];
$routes[] = ['GET|POST', '/admin/customers/form/[i:id]?', 'Avonlea\Controller\AdminCustomers#form'];
$routes[] = ['GET|POST', '/admin/customers/addresses/[i:id]', 'Avonlea\Controller\AdminCustomers#addresses'];
$routes[] = ['GET|POST', '/admin/customers/delete/[i:id]?', 'Avonlea\Controller\AdminCustomers#delete'];
$routes[] = ['GET|POST', '/admin/customers/groups', 'Avonlea\Controller\AdminCustomers#groups'];
$routes[] = ['GET|POST', '/admin/customers/group_form/[i:id]?', 'Avonlea\Controller\AdminCustomers#groupForm'];
$routes[] = ['GET|POST', '/admin/customers/delete_group/[i:id]?', 'Avonlea\Controller\AdminCustomers#deleteGroup'];
$routes[] = ['GET|POST', '/admin/customers/address_list/[i:id]?', 'Avonlea\Controller\AdminCustomers#addressList'];
$routes[] = ['GET|POST', '/admin/customers/address_form/[i:customer_id]/[i:id]?', 'Avonlea\Controller\AdminCustomers#addressForm'];
$routes[] = ['GET|POST', '/admin/customers/delete_address/[i:customer_id]/[i:id]', 'Avonlea\Controller\AdminCustomers#deleteAddress'];
$routes[] = ['GET|POST', '/admin/customers/[:order_by]?/[:direction]?/[i:page]?', 'Avonlea\Controller\AdminCustomers#index'];

//manifest
$classMap['Avonlea\Controller\AdminCustomers'] = 'controllers/AdminCustomers.php';
