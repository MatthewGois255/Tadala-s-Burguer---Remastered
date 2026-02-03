<?php

require __DIR__ . '/includes/app.php';

use \App\Http\Router;

$router = new Router(URL);

// Inclui as rotas
include __DIR__ . '/src/routes/pages.php';

$router ->run()
        ->sendResponse();