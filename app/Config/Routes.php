<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');
$routes->get('/login', 'Auth::login');
$routes->get('/register', 'Auth::register');
$routes->get('/products', 'Product::index');
$routes->get('/admin', 'Admin\Dashboard::index');
$routes->post(
    '/register/save',
    'Auth::saveRegister'
);
$routes->post(
    '/login/check',
    'Auth::checkLogin'
);
$routes->get('/logout', 'Auth::logout');
$routes->get(
    '/admin/categories',
    'Admin\Category::index'
);
$routes->get(
    '/admin/categories/create',
    'Admin\Category::create'
);
$routes->post(
    '/admin/categories/store',
    'Admin\Category::store'
);
$routes->get(
    '/admin/products',
    'Admin\Product::index'
);

$routes->get(
    '/admin/products/create',
    'Admin\Product::create'
);

$routes->post(
    '/admin/products/store',
    'Admin\Product::store'
);
$routes->get(
    '/admin/products/edit/(:num)',
    'Admin\Product::edit/$1'
);

$routes->post(
    '/admin/products/update/(:num)',
    'Admin\Product::update/$1'
);
$routes->get(
    '/admin/products/delete/(:num)',
    'Admin\Product::delete/$1'
);
$routes->get(
    '/admin/products/variants/(:num)',
    'Admin\VariantGroup::index/$1'
);
$routes->get(
    '/admin/products/variants/create/(:num)',
    'Admin\VariantGroup::create/$1'
);

$routes->post(
    '/admin/products/variants/store/(:num)',
    'Admin\VariantGroup::store/$1'
);
$routes->get(
    '/admin/products/variants/edit/(:num)',
    'Admin\VariantGroup::edit/$1'
);

$routes->post(
    '/admin/products/variants/update/(:num)',
    'Admin\VariantGroup::update/$1'
);

$routes->get(
    '/admin/products/variants/delete/(:num)',
    'Admin\VariantGroup::delete/$1'
);
$routes->get(
    '/admin/variants/(:num)',
    'Admin\Variant::index/$1'
);
$routes->get(
    '/admin/variants/create/(:num)',
    'Admin\Variant::create/$1'
);

$routes->post(
    '/admin/variants/store/(:num)',
    'Admin\Variant::store/$1'
);

$routes->get(
    '/admin/variants/edit/(:num)',
    'Admin\Variant::edit/$1'
);

$routes->post(
    '/admin/variants/update/(:num)',
    'Admin\Variant::update/$1'
);

$routes->get(
    '/admin/variants/delete/(:num)',
    'Admin\Variant::delete/$1'
);
$routes->get(
    '/admin/products/images/(:num)',
    'Admin\ProductImage::index/$1'
);
$routes->post(
    '/admin/products/images/store/(:num)',
    'Admin\ProductImage::store/$1'
);
$routes->get(
    '/admin/products/images/delete/(:num)',
    'Admin\ProductImage::delete/$1'
);
$routes->get('/products', 'Product::index');
$routes->get(
    '/products/detail/(:num)',
    'Product::detail/$1'
);
$routes->get(
    '/products/custom/(:num)',
    'Product::custom/$1'
);
$routes->group('cart', function($routes){

    $routes->get('/', 'CartController::index');

    $routes->post('add', 'CartController::add');

    $routes->get('remove/(:num)', 'CartController::remove/$1');

});
$routes->get('/cart', 'CartController::index');
$routes->group('addresses', function($routes){

    $routes->get('/', 'AddressController::index');

    $routes->get(
        'create',
        'AddressController::create'
    );

    $routes->post(
        'store',
        'AddressController::store'
    );

    $routes->get(
        'delete/(:num)',
        'AddressController::delete/$1'
    );

    $routes->get(
        'default/(:num)',
        'AddressController::setDefault/$1'
    );
});
$routes->group('checkout', function($routes){

    $routes->get('/', 'CheckoutController::index');

});
$routes->get(
    'checkout',
    'CheckoutController::index'
);
$routes->post(
    'checkout/process',
    'CheckoutController::process'
);
$routes->get(
    'payment/(:num)',
    'PaymentController::index/$1'
);

$routes->post(
    'payment/webhook',
    'PaymentController::webhook'
);
/*
====================================
CUSTOMER ORDERS
====================================
*/

$routes->get(
    'orders',
    'OrderController::index'
);

$routes->get(
    'orders/(:num)',
    'OrderController::detail/$1'
);

$routes->get(
    'orders/request-refund/(:num)',
    'OrderController::requestRefund/$1'
);

/*
====================================
ADMIN ORDERS
====================================
*/

$routes->get(
    'admin/orders',
    'AdminOrderController::index'
);

$routes->get(
    'admin/orders/(:num)',
    'AdminOrderController::detail/$1'
);

$routes->post(
    'admin/orders/update-status',
    'AdminOrderController::updateStatus'
);
$routes->get(
    'admin/users',
    'AdminUserController::index'
);

$routes->get(
    'admin/users/(:num)',
    'AdminUserController::detail/$1'
);
$routes->get(
    'profile',
    'ProfileController::index'
);

$routes->post(
    'profile/update',
    'ProfileController::update'
);
$routes->get(
    '/admin/export-pdf',
    'Admin\Dashboard::exportPdf'
);

$routes->get(
    '/admin/export-csv',
    'Admin\Dashboard::exportCsv'
);