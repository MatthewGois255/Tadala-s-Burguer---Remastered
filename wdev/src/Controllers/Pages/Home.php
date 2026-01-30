<?php

namespace App\Controllers\Pages;

use App\Utils\View;

class Home extends Page {
    public static function getHome() {
        $content = View::render('pages/home', [
            'nome' => 'campeão do Brasileirão'
        ]);
        return parent::getPage("São Paulo", $content);
    }
}