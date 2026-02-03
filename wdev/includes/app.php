<?php

require __DIR__ . '/../vendor/autoload.php';

use \App\Utils\View;
use \App\Utils\Environment;

Environment::load(__DIR__ . '/../');

define('URL', getenv('URL'));

// Enviar variáveis padrões para todas as Views
View::init([
    'URL' => URL
]);