<?php

namespace App\Controller;

use App\Controller\Controller;
use App\Model\CommentsManager;
use App\Model\PostsManager;
use App\Model\UsersManager;

class AdminController extends Controller {
    
    public static function index(){
        $posts =new PostsManager;
        $comments = new CommentsManager;
        $users = new UsersManager;

        echo self::getTwig()->render('admin/admin.html',[
            'posts'=>$posts ->readAll(),
            'comments'=> $comments->findAll(0),
            'allusers'=>$users ->findAll(2),
            'users'=> $users->findAll(1),
            ]);
    }
    public static function create() {
        echo self::getTwig()->render('article/create.html');
        
    }
    public static function edit(int $id){
        $post =new PostsManager;

        echo self::getTwig()->render('article/edit.html', [
            'post' => $post ->readOne($id),
        ]);
    }
}