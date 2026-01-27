<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;

class NotFoundController {
    public function index(Request $request, Response $response) {
        Response::json([
            'error' => true,
            'sucess' => false,
            'message' => "Sorry, route not found"
        ], 404);
        return;
    }
}