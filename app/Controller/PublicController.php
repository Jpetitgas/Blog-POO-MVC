<?php

namespace App\Controller;

class PublicController extends Controller 
{

    public static function index() 
    {
        echo self::getTwig()->render('app/index.html');
    }
    public static function forbidden() 
    {
        echo self::getTwig()->render('app/403.html');
    }
      
}