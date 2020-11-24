<?php

namespace App\Model;

use PDOException;
use PDO;
use App\controller\MessageController;

abstract class Manager
{

    protected static function getPdo()
    {
        try {
            $bdd = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
            return $bdd;
        } catch (PDOException $e) {
            
        }
    }

    /**
     * arrayToObject
     * met les objets dans un tableau
     * @param  mixed $array
     * @param  mixed $table
     * @return $array
     */
    protected function arrayToObject(array $array, string $table)
    {
        $entity = 'App\Model\Entity\\' . ucfirst($table) . 'Entity';
        $dataAsObjects = [];

        foreach ($array as $one) {
            $single = new $entity($one);
            $dataAsObjects[] = $single;
        }
        return $dataAsObjects;
    }
    /**
     * getFormattedDateTime
     * met la date passée en parametre à l'heure de la france
     * @return void
     */
    protected function getFormattedDateTime()
    {
        date_default_timezone_set('Europe/Paris');
        setlocale(LC_TIME, 'fr_FR.utf8', 'fra');
        $date = date("Y-m-d H:i:s");


        return $date;
    }
}
