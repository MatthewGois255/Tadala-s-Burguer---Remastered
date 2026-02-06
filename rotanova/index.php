<?php

require_once __DIR__ . "/vendor/autoload.php";
require_once __DIR__ . "/app/routes/main.php";

use App\Core\Router;
use App\Http\Route;

Router::dispatch(Route::routes());