<?php

//routes
$routes[] = ['GET|POST', '/addresses', 'Avonlea\Controller\Addresses#index'];
$routes[] = ['GET|POST', '/addresses/json', 'Avonlea\Controller\Addresses#addressJSON'];
$routes[] = ['GET|POST', '/addresses/form/[i:id]?', 'Avonlea\Controller\Addresses#form'];
$routes[] = ['GET|POST', '/addresses/delete/[i:id]', 'Avonlea\Controller\Addresses#delete'];
$routes[] = ['GET|POST', '/addresses/get-zone-options/[i:id]', 'Avonlea\Controller\Addresses#getZoneOptions'];
