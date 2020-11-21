<?php

namespace App\Controller;

use App\Model\UsersManager;
use App\Model\Entity\UserEntity;


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
        $users = new UsersManager();
        $controlled_array = self::Control_array();
        $user = $users->get($controlled_array['username']);

        if (empty($user)) {
            self::message("l'utilisateur n'existe pas");
            die();
        }
        if ($user[0]->valided() == 1) {
            self::message("Le compte n'est pas encore actif");
            die();
        }
        if ($user[0]->password() === sha1($controlled_array['password'])) {
            self::put('auth', $user[0]->id());
            self::put('role' ,$user[0]->role());
            self::put('user' , $controlled_array['username']);
        } else {
            self::message("Le mot de passe n'est pas correct");
            die();
        }
        if (isset($_COOKIE['undo'])) {
            $undo = $_COOKIE['undo'];
            $redir = 'location: ' . $undo;
            return header($redir);
        } else {
            $redir = 'location: /';
            return header($redir);
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
        $undo = $_SERVER['HTTP_REFERER'];
        $redir = 'location: ' . $undo;
        return header($redir);
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

    /**
     * validation
     *enregistrement d'un nouveau utilisateur
     * @return void
     */
    public static function validation()
    {
        $controlled_array = self::Control_array();
        $controlled_array['password'] = sha1($controlled_array['password']);
        
        $user = new UserEntity($controlled_array);
        $users = new UsersManager;
        $users->create($user);
        $redir = 'location: /admin';
        return header($redir);
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
        
        

        $message = "bonjour ". $user->Username() ." , votre compte a été validé!";
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
    public static function delete()
    {
        $controlled_array = self::Control_array();
        $users = new UsersManager;
        $id = self::valid_data($controlled_array['id']);
        $user = $users->readOne($id);
        $users->delete($user);
        $redir = 'location: /admin';
        return header($redir);
    }
}
