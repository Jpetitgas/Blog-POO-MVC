<?php

namespace App\Controller;

class PublicController extends Controller 
{

    public static function index() 
    {
        self::global();
        echo self::getTwig()->render('app/index.html',[
            'global'=>self::$global,
            ]);
    }
    public static function forbidden() 
    {
        echo self::getTwig()->render('app/403.html');
    }
      
}