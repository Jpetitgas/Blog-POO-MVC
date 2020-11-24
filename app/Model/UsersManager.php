<?php

namespace App\Model;

use App\Model\Entity\userEntity;
use Exception;

class UsersManager extends Manager
{
    protected static $bdd;

    function __construct()
    {
        $bdd = self::getPdo();
        if (!isset($bdd)) {
            throw new Exception("Impossible de se connecter à la base de données");
        }
        self::$bdd = $bdd;
    }

    /**
     * create
     * Enregistre un utilisateur
     * @param  mixed $user
     * @return void
     */
    public function create(UserEntity $user)
    {

        $query = 'INSERT INTO user(username, email, password) VALUES (:username, :email, :password)';
        $response =  self::$bdd->prepare($query);

        $response->execute([
            'username' => $user->username(),
            'email' => $user->email(),
            'password' => $user->password(),

        ]);

        return true;
    }


    /**
     * findAll
     * Retourne la liste de tous les users validé (2) ou pas (1) en fonction du param passé
     * @param  mixed $valided
     * @return void
     */
    public function findAll(int $valided)
    {
        if ($valided == 1 | $valided == 0) {
            $query = "SELECT * FROM user where valided=$valided";
            $response =  self::$bdd->prepare($query);
            $response->execute();

            $allusers = $response->fetchAll();

            $objects = $this->arrayToObject($allusers, 'user');
            return $objects;
        }
    }


    /**
     * get
     * Retourne un utilisateur dont le username est passé en parametre
     * @param  mixed $username
     * @return array
     */
    public function get(string $username)
    {

        $query = "SELECT * FROM user WHERE username= ?";
        $response =  self::$bdd->prepare($query);
        $response->execute(array($username));
        $allusers = $response->fetchAll();

        $objects = $this->arrayToObject($allusers, 'user');
        return $objects;
    }

    /**
     * readAll
     * Retourne tous les utilisateurs
     * @return void
     */
    public function readAll()
    {
        $query = "SELECT * FROM user order by id";
        $response =  self::$bdd->prepare($query);
        $response->execute();

        $allusers = $response->fetchAll();

        $objects = $this->arrayToObject($allusers, 'user');
        return $objects;
    }
    /**
     * readOne
     * Retourne un user en fonction de l'id passé
     * @param  mixed $id
     * @return object
     */
    public function readOne(int $id_user)
    {
        $query = "SELECT * FROM user WHERE id= ?";
        $response =  self::$bdd->prepare($query);
        $response->execute(array($id_user));
        $data = $response->fetch();
        $user = new UserEntity($data);
        return $user;
    }

    /**
     * valided
     * valide un user 
     * @param  mixed $user
     * @return void
     */
    public function valided(userEntity $user)
    {
        $query = ("UPDATE user SET valided= '1' WHERE id = :id ");
        $response =  self::$bdd->prepare($query);
        $response->execute([
            'id' => $user->id(),
        ]);
    }

    /**
     * update
     *Met à jour un utilisateur
     * @param  mixed $user
     * @return void
     */
    public function update(userEntity $user)
    {
        $query = ("UPDATE user SET username= :username, role= :role, email= :email WHERE id = :id ");
        $response =  self::$bdd->prepare($query);
        $response->execute([
            'username' => $user->username(),
            'email' => $user->email(),
            'id' => $user->id(),
            'role' => $user->role(),

        ]);
    }

    public function updatepw(userEntity $user)
    {
        $query = ("UPDATE user SET password= :password WHERE id = :id ");
        $response =  self::$bdd->prepare($query);
       
        $response->execute([
            'password' => $user->password(),
            'id' => $user->id(),
        ]);
    }

    /** 
     *supprime un utilisateur
     */
    public function delete(userEntity $user)
    {
        $query = "DELETE FROM user WHERE id= ?";
        $response =  self::$bdd->prepare($query);
        $id = array($user->id());
        $response->execute($id);
    }
}
