<?php

$routes[] = ['GET|POST', '/admin/settings', 'Avonlea\Controller\AdminSettings#index'];
$routes[] = ['GET|POST', '/admin/settings/canned_messages', 'Avonlea\Controller\AdminSettings#canned_messages'];
$routes[] = ['GET|POST', '/admin/settings/canned_message_form/[i:id]?', 'Avonlea\Controller\AdminSettings#canned_message_form'];
$routes[] = ['GET|POST', '/admin/settings/delete_message/[i:id]', 'Avonlea\Controller\AdminSettings#delete_message'];
