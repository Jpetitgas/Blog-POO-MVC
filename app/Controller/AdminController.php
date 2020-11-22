<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Model\CommentsManager;
use App\Model\PostsManager;
use App\Model\UsersManager;
use Exception;
class AdminController extends Controller
{

    /**
     * index
     * genere le tableau de bord
     * @return void
     */
    public static function index()
    {
        try{
        $posts = new PostsManager;
        $comments = new CommentsManager;
        $users = new UsersManager;
        self::global();

        self::view (self::getTwig()->render('admin/admin.html', [
            'posts' => $posts->readAll(),
            'comments' => $comments->findAll(0),
            'allusers' => $users->findAll(2),
            'users' => $users->findAll(1),
            'global' => self::$global,
        ]));
    } catch (Exception$e){
        $affiche = new MessageController; 
        $affiche->message($e->getMessage());
}
    }
    /**
     * create
     *genere le formulaire pour créer un post
     * @return void
     */
    public static function create()
    {
        self::global();
        self::view (self::getTwig()->render('article/create.html', [
            'global' => self::$global,
        ]));
    }

    /**
     * edit
     * edite un post pour modification
     * @param  mixed $id
     * @return void
     */
    public static function edit(int $id_post)
    {
        try{
        $id_post = self::valid_data($id_post);
        $post = new PostsManager;
        self::global();
        self::view ( self::getTwig()->render('article/edit.html', [
            'post' => $post->readOne($id_post),
            'global' => self::$global,
        ]));
    } catch (Exception$e){
        $affiche = new MessageController; 
        $affiche->message($e->getMessage());
}
    }
}
