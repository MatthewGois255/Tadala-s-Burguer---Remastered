<?php

namespace App\Http;

class Response {
    public static function json(array $data = [], int $status = 200) {
        http_response_code($status);
        
        header('Content-Type: application/json');

        echo json_encode($data);
    }

    public static function html($content, int $status = 200) {
        http_response_code($status);
        
        header('Content-Type: text/html');

        echo $content;
    }
}


class Response2 {
    private $httpCode = 200;
    private $headers = [];
    private $contentType = 'text/html';
    private $content;

    public function __construct($httpCode, $content, $contentType = 'text/html')
    {
        $this->httpCode = $httpCode;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    public function setContentType($contentType) {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    public function addHeader($key, $value) {
        $this->headers[$key] = $value;
    }

    private function sendHeader() {
        http_response_code($this->httpCode);

        foreach($this->headers as $key => $value) {
            header($key . ': ' . $value);
        }
    }

    public function sendResponse() {
        $this->sendHeader();

        switch($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit;
        }
    }
}