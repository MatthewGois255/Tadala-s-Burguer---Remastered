<?php

use \App\Http\Response;
use \App\Controllers\Admin;

$router->get('/admin', [
    'middlewares' => [
        'required-admin-log'
    ],
    function() {
        return new Response(200, 'Admin :)');
    }
]);

$router->get('/admin/login', [
    'middlewares' => [
        'required-admin-logout'
    ],
    function($request) {
        return new Response(200, Admin\Login::getLogin($request));
    }
]);

$router->post('/admin/login', [
    'middlewares' => [
        'required-admin-logout'
    ],
    function($request) {
        print_r($request->getPostVars());
        exit;
        return new Response(200, Admin\Login::getLogin($request));
    }
]);

// Rota de logout
$router->get('/admin/logout', [
    'middlewares' => [
        'required-admin-login'
    ],
    function($request) {
        return new Response(200, Admin\Login::setLogout($request));
    }
]);