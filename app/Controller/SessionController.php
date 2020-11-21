<?php

namespace App\Controller;

class SessionController extends Controller
{
    public static function put($key, $value){
        $_SESSION[$key] = $value;
    }

    public static function get($key){
        return (isset($_SESSION[$key]) ? $_SESSION[$key] : null);
    }

    public static function forget($key){
        unset($_SESSION[$key]);
    }
/*

    protected static function global()
    {
        if (isset($_SESSION['auth'])) {
            self::$global['connect'] = 1;
            self::$global['username'] = $_SESSION['user'];
            self::$global['userid'] = $_SESSION['auth'];
            self::$global['role'] = $_SESSION['role'];
        } else {
            self::$global['connect'] = 2;
            self::$global['username'] = "";
            self::$global['userid'] = "";
            self::$global['role'] ="";
        }
    }*/
}