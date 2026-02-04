<?php

namespace App\Controllers\Admin;

use \App\Utils\View;

class Login extends Page{
    public static function getLogin($request) {
        $content = View::render('admin/login', []);
        
        return parent::getPage($content);
    }
}