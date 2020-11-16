<?php

namespace App\Controller;

use App\Model\CommentsManager;
use App\Model\PostsManager;
use App\Model\Entity\PostEntity;

class PostsController extends Controller{

    public static function record() {
        $controlled_array=self::Control_array($_POST);
        $post = new PostEntity($controlled_array);
        $posts =new PostsManager;
        $posts ->create($post);
        $redir='location: /admin';
        return header($redir);
    }

    public static function all(){
        $posts =new PostsManager;
       
        echo self::getTwig()->render('article/all.html',[
            'posts'=>$posts ->readAll(),
            ]);
    }
    public static function one(int $id){
        $post =new PostsManager;
        $comments= new CommentsManager;
        if (isset($_SESSION['auth'])){
            $connect=true;
        } else {
            $connect=false;
        }
        echo self::getTwig()->render('article/one.html', [
            'post' => $post ->readOne($id),
            'comments'=> $comments->findAllValidedByPost($id),
            'auth'=>$connect
        ]);
        
    }
   
    public static function update() {
        $posts =new PostsManager;
        $controlled_array=self::Control_array($_POST);
        $post= $posts->readOne($controlled_array['id']);
        $post->hydrate($controlled_array);
        $posts ->update($post);
        $redir='location: /admin';
        return header($redir);
    }

    public static function delete(int $id) {
        $posts =new PostsManager;
        $comments=new CommentsManager;
        $commentsOfPost=$comments->findAllByPost($id);
        foreach ($commentsOfPost as $comment ){
            $comments->delete($comment);
        }
        $post= $posts->readOne($id);
        $posts->delete($post);
        $redir='location: /admin';
        return header($redir);
    }
    
    
   
}