<?php

namespace App\Model;

class UserMapManager extends Manager
{
     /**
     * Retourne tous les maps d'un user
     */
    public function get(array $param)
    {
        $query = "SELECT * FROM user_map WHERE id_user= :id_user and id_group= :id_group ";
        $response = self::getPdo()->prepare($query);
        $response->execute($param);
        $allusers = $response->fetchAll();
        $objects=$this->arrayToObject($allusers, 'user_map');
        return $objects;
        
    }
    
    
}
