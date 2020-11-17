<?php

namespace App\Controller;

use App\Model\CommentsManager;

use App\Model\Entity\CommentEntity;

class CommentsController extends Controller{

    public static function record(){
        $controlled_array=self::Control_array($_POST);
        $comment = new CommentEntity($controlled_array);
        $comments= new CommentsManager;
        $comments ->store($comment);
        $rediction= 'location: /articles/'.$_POST['id'];
        return header($rediction);
        
    }

    public static function valided() {
        $comments =new CommentsManager;
        $id=self::valid_data($_POST['id']);
        $comment= $comments->readOne($id);
        $comment->hydrate($_POST);
        $comments ->update($comment);
        $rediction='location: /admin';
        return header($rediction);
    }

    public static function delete() {
        $comments =new commentsManager;
        $id=self::valid_data($_POST['id']);
        $comment= $comments->readOne($id);
        $comments->delete($comment);
        $redir='location: /admin';
        return header($redir);
    }
    
    
   
}