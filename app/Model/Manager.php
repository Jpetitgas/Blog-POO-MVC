<?php

namespace App\Model;

use PDO;

abstract class Manager {

    public static function getPdo() {
        return new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
    
    /**
     * 
     * 
     */
    
    protected function arrayToObject(array $array, string $table)
    {
        $entity='App\Model\Entity\\'. ucfirst ($table).'Entity';
        $dataAsObjects = [];
       
        foreach($array as $one) {
            $single = new $entity($one);
            //$single->hydrate($one);
            $dataAsObjects[] =$single;
        }
        return $dataAsObjects;
    }
}