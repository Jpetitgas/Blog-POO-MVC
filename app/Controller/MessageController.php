<?php

namespace App\Controller;



/**
 * MessageController
 * gere les pages de message
 */
class MessageController extends Controller
{
    /**
     * message
     *fonction qui genere la page avec un message passé en parametre
     * @param  mixed $message
     * @return void
     */
    public function message(string $message)
    {

        self::global();
        self::view(self::getTwig()->render('app/message.html', [
            'message' => $message,
            'global' => self::$global,
        ]));
    }
}
