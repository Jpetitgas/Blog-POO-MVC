<?php

namespace App\Controller;

/**
 * Classe modélisant la session.
 * Encapsule la superglobale PHP $_SESSION.
 */
class Session
{
    
    public static function put($key, $value)
    {
        $key = htmlspecialchars($key);
        $value = htmlspecialchars($value);
        $_SESSION[$key] = $value;
    }

    public static function get($key)
    {
        return (isset($_SESSION[$key]) ? $_SESSION[$key] : null);
    }

    
}
