<?php

namespace App\Controllers\Pages;

use App\Utils\View;

class Page {
    private static function getHeader() {
        return View::render('pages/header');
    }
    
    private static function getFooter() {
        return View::render('pages/footer');
    }
    
    public static function getPage($time, $content) {
        return View::render('pages/page', [
            'time' => $time,
            'header' => self::getHeader(),
            'content' => $content,
            'footer' => self::getFooter()
        ]);
    }
}