<?php

namespace App\Controller;

class FormController extends Controller
{    
    /**
     * index
     *genere le formulaire 
     * @return void
     */
    public static function index() 
    {
        self::global();
        echo self::getTwig()->render('app/form.html',[
        'global'=>self::$global,
            ]);
    }    
    /**
     * sent
     *envoie le mail à l'administrateur
     * @return void
     */
    public static function sent()
    {
        $controlled_array = self::Control_array($_POST);
        $message= $controlled_array['name']. ' '.$controlled_array['prenom'] .'('.$controlled_array['email'].') vous à envoyer le message suivant :'. $controlled_array['content'];
        $email=MAIL;
        self::sentMail($email, 'formulaire de contact', $message);
    }
}