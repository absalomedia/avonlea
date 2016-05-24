<?php

$routes[] = ['GET|POST', '/admin/locations/zone_areas/[i:id]', 'Avonlea\Controller\AdminLocations#zone_areas'];
$routes[] = ['GET|POST', '/admin/locations/delete_zone_area/[i:id]', 'Avonlea\Controller\AdminLocations#delete_zone_area'];
$routes[] = ['GET|POST', '/admin/locations/zone_area_form/[i:zone_id]/[i:id]?', 'Avonlea\Controller\AdminLocations#zone_area_form'];
$routes[] = ['GET|POST', '/admin/locations/zones/[i:id]', 'Avonlea\Controller\AdminLocations#zones'];
$routes[] = ['GET|POST', '/admin/locations/zone_form/[i:id]?', 'Avonlea\Controller\AdminLocations#zone_form'];
$routes[] = ['GET|POST', '/admin/locations/delete_zone/[i:id]', 'Avonlea\Controller\AdminLocations#delete_zone'];
$routes[] = ['GET|POST', '/admin/locations/get_zone_menu', 'Avonlea\Controller\AdminLocations#get_zone_menu'];
$routes[] = ['GET|POST', '/admin/locations/country_form/[i:id]?', 'Avonlea\Controller\AdminLocations#country_form'];
$routes[] = ['GET|POST', '/admin/locations/delete_country/[i:id]', 'Avonlea\Controller\AdminLocations#delete_country'];
$routes[] = ['GET|POST', '/admin/locations/organize_countries', 'Avonlea\Controller\AdminLocations#organize_countries'];
$routes[] = ['GET|POST', '/admin/locations', 'Avonlea\Controller\AdminLocations#index'];
