<?php

use \App\Http\Response;
use \App\Controllers\Pages;


$obj->get('/saopaulo', [
    function() {
        return new Response(200, Pages\Home::index());
    }
]);