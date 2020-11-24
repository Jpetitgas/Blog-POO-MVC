<?php

namespace App\Controller;

use Exception;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use App\Controller\MessageController;

abstract class Controller
{
    protected static $global = [];


    public static function getTwig()
    {
        $loader = new FilesystemLoader(ROOT . '/views');
        $twig = new Environment($loader);
        $twig->addGlobal('assets',  ROOT . '/public/assets');
        $twig->addGlobal('base_path',  BASE_PATH);

        return $twig;
    }
    
    /**
     * Control_array
     *
     * passe les variables du tableau à la fonction valid_data($data)
     * 
     * @param  mixed $array
     * @return array
     */
    //array $array
    protected static function Control_array()
    {
        $array = $_POST;
        if (isset($array)) {
            $controlled_array = [];
            foreach ($array as $attribut => $valeur) {
                if (isset($valeur) and !empty($valeur)) {

                    $valeur = self::valid_data($valeur);
                    $attribut = self::valid_data($attribut);
                    $controlled_array[$attribut] = $valeur;
                } else {
                    throw new Exception('tous les champs doivent etre remplis');
                }
            }
        } else {
            throw new Exception('Veuillez remplir le formulaire');
        }

        return $controlled_array;
    }

    /**
     * valid_data
     *nettoie la variable passée à la fonction
     * @param  mixed $data
     * @return int
     */
    protected static function valid_data($data)
    {
        if (isset($data)) {
            $data = trim($data);
            $data = strip_tags($data);
            
        } else {
            throw new Exception('tous les champs doivent etre remplis');
        }

        return $data;
    }



    /**
     * global
     *prepare des variables permettant la construction des fichiers html
     *en particulier les elements qui doivent etre affiché apres connection
     * @return void
     */
    protected static function global()
    {
        $session = new Session;
        $auth = $session::get('auth');
        if (isset($auth)) {
            self::$global['connect'] = 1;
            self::$global['username'] = $session::get('user');
            self::$global['userid'] = $session::get('auth');
            self::$global['role'] = $session::get('role');
            self::$global['token'] = $session::get('token');
        } else {
            self::$global['connect'] = 2;
            self::$global['username'] = "";
            self::$global['userid'] = "";
            self::$global['role'] = "";
            self::$global['token'] = "";
        }
    }

    /**
     * sentMail
     *envoi de mail
     * 
     * @param  mixed $subject
     * @param  mixed $message
     * @return void
     */
    protected static function sentMail($email, $subject, $message)
    {
        if (mail($email, $subject, $message)) {
            $message = "Email envoyé avec succès";
        } else {
            $message = "Échec de l'envoi de l'email...";
        }
        $affiche = new MessageController;
        $affiche->message($message);
    }
}
