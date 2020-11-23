<?php

namespace App\Controller;

use App\Model\UsersManager;
use App\Model\Entity\UserEntity;
use Exception;

class UsersController extends Controller
{


    /**
     * login
     *genere le formulaire de connection
     * @return void
     */
    public static function login()
    {
        echo self::getTwig()->render('app/login.html');
    }

    /**
     * checkLogin
     *verification de l'identifiant et mot de passe
     *met à jour les variable de session
     * @return void
     */
    public static function checkLogin()
    {
        try {
            $users = new UsersManager();
            $controlled_array = self::Control_array();
            $user = $users->get($controlled_array['username']);
            $session = new Session;
            if (empty($user)) {
                throw new Exception("l'utilisateur n'existe pas");
            }
            if ($user[0]->valided() == 0) {
                throw new Exception("Le compte n'est pas encore actif");
            }
            if ($user[0]->password() === sha1($controlled_array['password'])) {
                $session::put('auth', $user[0]->id());
                $session::put('role', $user[0]->role());
                $session::put('user', $controlled_array['username']);
                $session::put('token', bin2hex(openssl_random_pseudo_bytes(6)));
            } else {
                throw new Exception("Le mot de passe n'est pas correct");
            }
            if (isset($_COOKIE['undo'])) {
                $undo = $_COOKIE['undo'];
                $redir = 'location: ' . $undo;
                return header($redir);
            } else {
                $redir = 'location: /';
                return header($redir);
            }
        } catch (Exception $e) {
            $affiche = new MessageController;
            $affiche->message($e->getmessage());
        }
    }
    public static function modification()
    {
        try {
            $users = new UsersManager();
            $controlled_array = self::Control_array();
            $user = $users->readOne($controlled_array['id']);
            $session = new Session;
            if (empty($user)) {
                throw new Exception("l'utilisateur n'existe pas");
            }
            if ($user->password() === sha1($controlled_array['oldpassword'])) {
                $user->setPassword(sha1($controlled_array['newpassword']));
                $users->updatepw($user);
            } else {
                throw new Exception("Le mot de passe n'est pas correct");
            }
            $affiche = new MessageController;
            $affiche->message('Votre mot de passe est modifié');
            
        } catch (Exception $e) {
            $affiche = new MessageController;
            $affiche->message($e->getmessage());
        }
    }
    
    /**
     * unlogged
     *fonction de deconnection et de suppression des variable session
     * @return void
     */
    public static function unlogged()
    {
        session_unset();
        if (isset($_SERVER['HTTP_REFERER'])) {
            $undo = $_SERVER['HTTP_REFERER'];
        }
        $affiche = new MessageController;
            $affiche->message('Vous etes deconnecté');
        
    }

    /**
     * edit
     *edite un utilisateur pour modification
     * @param  mixed $id
     * @return void
     */
    public static function edit(int $id)
    {
        $id = self::valid_data($id);
        $user = new UsersManager;
        echo self::getTwig()->render('app/useredit.html', [
            'user' => $user->readOne($id),
        ]);
    }
    /**
     * registration
     *genere le formulaire d'enregistrement
     * @return void
     */
    public static function registration()
    {
        echo self::getTwig()->render('app/registration.html');
    }
    public static function change()
    {
        self::global();
        echo self::getTwig()->render('app/change.html', [
            'global' => self::$global,
        ]);
    }

    /**
     * validation
     *enregistrement d'un nouveau utilisateur
     * @return void
     */
    public static function validation()
    {
        try {
            $controlled_array = self::Control_array();
            $controlled_array['password'] = sha1($controlled_array['password']);
            $users = new UsersManager;
            //verification de la non existance du nom d'utilisateur

            if (!empty($users->get($controlled_array['username']))) {
                throw new Exception("Ce nom d'utilisateur existe déjà");
            }
            $user = new UserEntity($controlled_array);

            $users->create($user);
            $redir = 'location: /admin';
            return header($redir);
        } catch (Exception $e) {
            $affiche = new MessageController;
            $affiche->message($e->getmessage());
        }
    }
    /**
     * valided
     * validation d'un nouveeu utilisateur et envoi d'un mail de confirmation
     * @return void
     */
    public static function valided()
    {
        $controlled_array = self::Control_array();
        $users = new UsersManager;
        $id = self::valid_data($controlled_array['id']);
        $user = $users->readOne($id);
        $user->hydrate($controlled_array);
        $users->valided($user);



        $message = "bonjour " . $user->Username() . " , votre compte a été validé!";
        self::sentMail($user->email(), "validation de votre compte", $message);
    }
    /**
     * update
     * mise à jour de l'utilisateur
     * @return void
     */
    public static function update()
    {
        $users = new UsersManager;
        $id = self::valid_data($_POST['id']);
        $user = $users->readOne($id);
        $controlled_array = self::Control_array($_POST);
        $user->hydrate($controlled_array);
        $users->update($user);
        $redir = 'location: /admin';
        return header($redir);
    }
    /**
     * delete
     * suppression de l'utilisateur dont id est passé en parametre
     * @return void
     */
    public static function delete(int $id_user, $token)
    {
        try {
            $token = self::valid_data($token);
            if (!(isset($token) && ($token == $_SESSION['token']))) {
                throw new Exception('Token de session invalide');
            }
            $id_user = self::valid_data($id_user);
            $users = new UsersManager;
            $user = $users->readOne($id_user);
            $users->delete($user);
            $redir = 'location: /admin';
            return header($redir);
        } catch (Exception $e) {
            $affiche = new MessageController;
            $affiche->message($e->getMessage());
        }
    }
}
