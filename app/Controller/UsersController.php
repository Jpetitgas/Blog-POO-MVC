<?php

namespace App\Controller;
use App\Model\UsersManager;
use App\Model\Entity\UserEntity;


class UsersController extends Controller 
{

      
    public static function login() 
    {
        echo self::getTwig()->render('app/login.html');
    }
    
    public static function checkLogin()
    {
        $users=new UsersManager();
        $controlled_array=self::Control_array($_POST);
        $user=$users->get($controlled_array['username']);
        
        if (empty($user)){
            echo("l'utilisateur n'existe pas");
            die();
        }
        if ($user[0]->valided()==1){
            echo("Le compte n'est pas encore actif");
            die();
        }
        if($user[0]->password() === sha1($_POST['password']))
            {
                $_SESSION['auth'] = $user[0]->id();
                $_SESSION['role'] = $user[0]->role();
            }  
              
        $redir='location: /';
        return header($redir);
        
    }
    
    public static function unlogged(){
        unset($_SESSION['auth']);
        return header('location: /');
    } 
    
    public static function edit(int $id){
        $id=self::valid_data($id);
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
            $controlled_array=self::Control_array($_POST);
            $user = new UserEntity($controlled_array);
            $users =new UsersManager;
            $users ->create($user);
            $redir='location: /admin';
            return header($redir);
         
    }
    public static function valided() {
        $users =new UsersManager;
        $id=self::valid_data($_POST['id']);
        $user= $users->readOne($id);
        $user->hydrate($_POST);
        $users ->valided($user);
        $rediction='location: /admin';
        return header($rediction);
    }
    public static function update() {
        $users =new UsersManager;
        $id=self::valid_data($_POST['id']);
        $user= $users->readOne($id);
        $controlled_array=self::Control_array($_POST);
        $user->hydrate($controlled_array);
        $users ->update($user);
        $redir='location: /admin';
        return header($redir);
    }
    public static function delete() {
        $users =new UsersManager;
        $id=self::valid_data($_POST['id']);
        $user= $users->readOne($id);
        $users->delete($user);
        $redir='location: /admin';
        return header($redir);
    }
    
}