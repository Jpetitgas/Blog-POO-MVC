<?php

namespace App\Controller;
use App\Model\UsersManager;
use App\Model\Entity\UserEntity;
use App\Model\UserMapManager;

class UsersController extends Controller 
{

      
    public static function login() 
    {
        echo self::getTwig()->render('app/login.html');
    }
    
    public static function checkLogin()
    {
        $users=new UsersManager();
        $user=$users->get($_POST['username']);
        $usermap= new UserMapManager();
        if($user[0]->password() === sha1($_POST['password']))
            {
                $_SESSION['auth'] = $user[0]->id();
                $a=['id_user'=>$user[0]->id(),'id_group'=>2];
                $b=$usermap->get($a);
                if (count($b)==1)
                {
                    $_SESSION['group'] = '2';
                } else {
                    $_SESSION['group'] = '1';
                }
            }
        $redir='location: /admin';
        return header($redir);
    }
    
    public static function unlogged(){
        unset($_SESSION['auth']);
        return header('location: /');
    } 
    
    public static function edit(int $id){
        $user =new UsersManager;

        echo self::getTwig()->render('app/useredit.html', [
            'user' => $user ->readOne($id),
        ]);
    }
    public static function registration() 
    {
        echo self::getTwig()->render('app/registration.html');
    }
    
    public static function validation() 
    {
            $_POST['password']=sha1($_POST['password']);
            $user = new UserEntity;
            $user->hydrate($_POST);
            $users =new UsersManager;
            $users ->create($user);
            $redir='location: /admin';
            return header($redir);
         
    }
    public static function valided() {
        $users =new UsersManager;
        $user= $users->readOne($_POST['id']);
        $user->hydrate($_POST);
        $users ->valided($user);
        $rediction='location: /admin';
        return header($rediction);
    }
    public static function update() {
        $users =new UsersManager;
        $user= $users->readOne($_POST['id']);
        $user->hydrate($_POST);
        $users ->update($user);
        $redir='location: /admin';
        return header($redir);
    }
    public static function delete() {
        $users =new UsersManager;
        $user= $users->readOne($_POST['id']);
        $users->delete($user);
        $redir='location: /admin';
        return header($redir);
    }
    
}