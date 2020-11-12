<?php

namespace App\Model;

class Animal {

    public static function index() {
        echo self::getTwig()->render('animal/index.html');
}
}