<?php

require __DIR__ . '/vendor/autoload.php';

use \App\Http\Router;
use \App\Http\Response;

define('URL', 'http://localhost/vitao');


$obj = new Router(URL);

// Inclui as rotas
include __DIR__ . '/routes/pages.php';

$obj->run()->sendResponse();