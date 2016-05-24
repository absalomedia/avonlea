<?php
$routes[] = ['GET|POST', '/cart/summary', 'Avonlea\Controller\Cart#summary'];
$routes[] = ['GET|POST', '/cart/add-to-cart', 'Avonlea\Controller\Cart#addToCart'];
$routes[] = ['GET|POST', '/cart/update-cart', 'Avonlea\Controller\Cart#updateCart'];
$routes[] = ['GET|POST', '/cart/submit-coupon', 'Avonlea\Controller\Cart#submitCoupon'];
$routes[] = ['GET|POST', '/cart/submit-gift-card', 'Avonlea\Controller\Cart#submitGiftCard'];
