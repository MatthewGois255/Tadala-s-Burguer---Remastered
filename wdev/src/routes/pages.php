<?php

use \App\Http\Response;
use \App\Controllers\Pages;

$obj->get('/usuario/{id}', [
    function($id) {
        return new Response(200, 'Usuário ' . $id);
    }
]);

$obj->get('/saopaulo', [
    function() {
        return new Response(200, Pages\Home::getHome());
    }
]);
