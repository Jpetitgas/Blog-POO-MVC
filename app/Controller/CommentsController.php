<?php

namespace App\Controller;

use App\Model\CommentsManager;

use App\Model\Entity\CommentEntity;

class CommentsController extends Controller{

    public static function record(){
        $comment = new CommentEntity($_POST);
        $comments= new CommentsManager;
        $comments ->store($comment);
        $rediction= 'location: /articles/'.$_POST['id'];
        return header($rediction);
        
    }

    public static function valided() {
        $comments =new CommentsManager;
        $comment= $comments->readOne($_POST['id']);
        $comment->hydrate($_POST);
        $comments ->update($comment);
        $rediction='location: /admin';
        return header($rediction);
    }

    public static function delete() {
        $comments =new commentsManager;
        $comment= $comments->readOne($_POST['id']);
        $comments->delete($comment);
        $redir='location: /admin';
        return header($redir);
    }
    
    
   
}