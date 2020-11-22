<?php

namespace App\Controller;

use Exception;

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
        self::view(self::getTwig()->render('app/form.html', [
            'global' => self::$global,
        ]));
    }
    /**
     * sent
     *envoie le mail à l'administrateur
     * @return void
     */
    public static function sent()
    {
        try {
            $controlled_array = self::Control_array();
            $message = $controlled_array['name'] . ' ' . $controlled_array['prenom'] . '(' . $controlled_array['email'] . ') vous à envoyer le message suivant :' . $controlled_array['content'];
            $email = MAIL;
            self::sentMail($email, 'formulaire de contact', $message);
        } catch (Exception $e) {
            self::message($e->getmessage());
        }
    }
}
