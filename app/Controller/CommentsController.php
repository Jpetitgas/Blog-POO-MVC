<?php

namespace App\Controller;

use App\Model\CommentsManager;
use Exception;
use App\Model\Entity\CommentEntity;

/**
 * CommentsController
 * CRUD de la table comment en lien avec CommentManager
 */
class CommentsController extends Controller
{

    public static function record()
    {
        try {
            $controlled_array = self::Control_array();
            $comment = new CommentEntity($controlled_array);
            $comments = new CommentsManager;
            $comments->store($comment);
            $rediction = 'location: /articles/' . $controlled_array['id'];
            return header($rediction);
        } catch (Exception $e) {
            $affiche = new MessageController;
            $affiche->message($e->getMessage());
        }
    }

    /**
     * valided
     * permet de passer le champ valided= '1'
     * @return void
     */
    public static function valided()
    {
        try {
            $controlled_array = self::Control_array();
            $comments = new CommentsManager;
            $id = self::valid_data($controlled_array['id']);
            $comment = $comments->readOne($id);
            $comment->hydrate($controlled_array);
            $comments->update($comment);
            $rediction = 'location: /admin';
            return header($rediction);
        } catch (Exception $e) {
            $affiche = new MessageController;
            $affiche->message($e->getMessage());
        }
    }

    /**
     * delete
     * supprime le comment dont id est passé en parametre
     * @return void
     */
    public static function delete(int $id_comment, $token)
    {
        try {
            $token = self::valid_data($token);
            if (!(isset($token) && ($token == $_SESSION['token']))) {
                throw new Exception('Token de session invalide');
            }
            $id_comment = self::valid_data($id_comment);
            $comments = new commentsManager;
            $comment = $comments->readOne($id_comment);
            $comments->delete($comment);
            $redir = 'location: /admin';
            return header($redir);
        } catch (Exception $e) {
            $affiche = new MessageController;
            $affiche->message($e->getMessage());
        }
    }
}
