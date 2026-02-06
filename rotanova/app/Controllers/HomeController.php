<?php

namespace App\Controllers;

use App\Http\Request;
use App\Http\Response;

class HomeController {

    private $request;
    private $response;

    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    public function index() {
        $this->response->html("<h1>Resp</h1>");
    }
}