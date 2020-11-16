<?php

namespace App\Controller;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

abstract class Controller {

    public static function getTwig() {
        $loader = new FilesystemLoader(__DIR__ . '/../../views');
        $twig = new Environment($loader);
        $twig->addGlobal('base_path',  BASE_PATH);
        return $twig;
    }
    
    protected static function Control_array(array $array){
            if (isset($array)){
                $controlled_array=[];
                foreach ($array as $attribut => $valeur){
                    if (isset($valeur) and !empty($valeur)){
                       
                        $valeur=self::valid_data($valeur);
                        $controlled_array[$attribut]= $valeur;
                    } 
                    else 
                    {
                        echo('le champ : '.$attribut.' ne doit pas etre vide');
                        die();
                    }
                }   
            } else {
                echo('Veuillez remplir le formulaire'); 
                die();
            }
        return $controlled_array;
    }

    protected static function valid_data($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
      } 
    
}