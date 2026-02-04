<?php

use \App\Http\Response;
use \App\Controllers\Admin;

$router->get('/admin', [
    function() {
        return new Response(200, 'Admin :)');
    }
]);

$router->get('/admin/login', [
    function($request) {
        return new Response(200, Admin\Login::getLogin($request));
    }
]);

$router->post('/admin/login', [
    function($request) {
        print_r($request->getPostVars());
        exit;
        return new Response(200, Admin\Login::getLogin($request));
    }
]);