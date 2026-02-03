<?php

use \App\Http\Response;
use \App\Controllers\Pages;

$router->get('/usuario/{id}', [
    function($id) {
        return new Response(200, Pages\Usuario::getUsuario($id));
    }
]);

$router->get('/saopaulo/{id}', [
    function($id) {
        return new Response(200, Pages\Home::getHome($id));
    }
]);
