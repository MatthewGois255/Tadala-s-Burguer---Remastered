<?php

namespace App\Controllers\Pages;

use App\Utils\View;

class Home extends Page {
    public static function getHome($id) {
        $content = View::render('pages/home', [
            'id' => $id
        ]);
        return parent::getPage("São Paulo", $content);
    }
}