<?php

namespace App\Controller;

class ArticlesController{

    public static function index(){
        echo "voici la liste des articles";
    }

    public static function show(int $id){
        echo "voici l'article numero ".$id;
    }
    public static function edit(int $id){
        echo "edition de l'article numero ".$id;
    }

}