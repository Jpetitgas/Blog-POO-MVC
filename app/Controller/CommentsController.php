<?php

namespace App\Controller;

use App\Model\CommentsManager;

use App\Model\Entity\CommentEntity;

/**
 * CommentsController
 * CRUD de la table comment en lien avec CommentManager
 */
class CommentsController extends Controller
{

    public static function record()
    {
        $controlled_array = self::Control_array();
        $comment = new CommentEntity($controlled_array);
        $comments = new CommentsManager;
        $comments->store($comment);
        $rediction = 'location: /articles/' . $controlled_array['id'];
        return header($rediction);
    }
    
    /**
     * valided
     * permet de passer le champ valided= '1'
     * @return void
     */
    public static function valided()
    {
        $controlled_array = self::Control_array();
        $comments = new CommentsManager;
        $id = self::valid_data($controlled_array['id']);
        $comment = $comments->readOne($id);
        $comment->hydrate($controlled_array);
        $comments->update($comment);
        $rediction = 'location: /admin';
        return header($rediction);
    }
    
    /**
     * delete
     * supprime le comment dont id est passé en parametre
     * @return void
     */
    public static function delete()
    {
        $controlled_array = self::Control_array();
        $comments = new commentsManager;
        $id = self::valid_data($controlled_array['id']);
        $comment = $comments->readOne($id);
        $comments->delete($comment);
        $redir = 'location: /admin';
        return header($redir);
    }
}
