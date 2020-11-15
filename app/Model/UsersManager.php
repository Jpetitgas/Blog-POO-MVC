<?php

namespace App\Model;

use App\Model\Entity\userEntity;

class UsersManager extends Manager
{

    /**
    * Enregistre un article
    */
    public function create(UserEntity $user) {

        $query = 'INSERT INTO user(username, email, password, valided) VALUES (:username, :email, :password, :valided)';
        $response = self::getPdo()->prepare($query);
            
        $response->execute([
            'username' => $user->username(),
            'email' => $user->email(),
            'password' => $user->password(),
            'valided'=> '0',
        ]);

        return true;
    }

     /** 
    * Retourne la liste des users
    */ 
    public function findAll(int $valided) {
        if ($valided==1 | $valided==0){
            $query = "SELECT * FROM user where valided=$valided";
            $response = self::getPdo()->prepare($query);
            $response->execute();

            $allusers = $response->fetchAll();
            
            $objects=$this->arrayToObject($allusers, 'user');
            return $objects;
        }
    }   

    /**
     * Retourne un utilisateur
     */
    public function get($username)
    {
              
        $query = "SELECT * FROM user WHERE username= ?";
        $response = self::getPdo()->prepare($query);
        $response->execute(array($username));
        $allusers = $response->fetchAll();
       
        $objects=$this->arrayToObject($allusers, 'user');
        return $objects;
        
    }
    /**
     * Retourne tous les utilisateurs
     */
    public function readAll() {
        
        $query = "SELECT * FROM user order by id";
        $response =self::getPdo()->prepare($query);
        $response->execute();

        $allusers = $response->fetchAll();
        
        $objects=$this->arrayToObject($allusers, 'user');
        return $objects;
    }
    
    
    /**
    * Retourne un user
    */
    public function readOne(int $id)
        {                     
            $query = "SELECT * FROM user WHERE id= ?";
            $response = self::getPdo()->prepare($query);
            $response->execute(array($id));
            $data = $response->fetch();
            $user =new UserEntity($data);
            return $user; 
        }
        /**
    * valide un user
    */
    public function valided(userEntity $user)
    {
        $query=("UPDATE user SET valided= '1' WHERE id = :id ");
        $response=self::getPdo()->prepare($query);
        $response->execute([
            'id'=>$user->id(),
            
        ]);   
    }
     /**
    * Met à jour un article
    */
    public function update(userEntity $user)
        {
            $query=("UPDATE user SET username= :username, email= :email WHERE id = :id ");
            $response=self::getPdo()->prepare($query);
            $response->execute([
                'username' => $user->username(),
                'email' => $user->email(),
                'id'=>$user->id(),
                
            ]);   
        }
    /** 
    *supprime un user
    */
    public function delete(userEntity $user)
    {
        $query = "DELETE FROM user WHERE id= ?";
        $response = self::getPdo()->prepare($query);
        $id=array($user->id());
        $response->execute($id);
    }   
    
}
