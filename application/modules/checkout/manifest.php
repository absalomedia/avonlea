<?php
$routes[] = ['GET|POST', '/checkout', 'Avonlea\Controller\Checkout#index'];
$routes[] = ['GET|POST', '/checkout/address-list', 'Avonlea\Controller\Checkout#addressList'];
$routes[] = ['GET|POST', '/checkout/submit-order', 'Avonlea\Controller\Checkout#submitOrder'];
$routes[] = ['GET|POST', '/order-complete/[:order_id]', 'Avonlea\Controller\Checkout#orderComplete'];
$routes[] = ['GET|POST', '/order-complete-email/[:order_id]', 'Avonlea\Controller\Checkout#orderCompleteEmail'];
$routes[] = ['GET|POST', '/checkout/address', 'Avonlea\Controller\Checkout#address'];
$routes[] = ['GET|POST', '/checkout/payment-methods', 'Avonlea\Controller\Checkout#paymentMethods'];
$routes[] = ['GET|POST', '/checkout/shipping-methods', 'Avonlea\Controller\Checkout#shippingMethods'];
$routes[] = ['GET|POST', '/checkout/set-shipping-method', 'Avonlea\Controller\Checkout#setShippingMethod'];
