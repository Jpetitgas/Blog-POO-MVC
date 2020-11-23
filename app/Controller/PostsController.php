<?php

namespace App\Controller;

use App\Model\CommentsManager;
use App\Model\PostsManager;
use App\Model\Entity\PostEntity;
use Exception;

/**
 * PostsController
 *  CRUD de la table post en lien avec PostManager
 * 
 */
class PostsController extends Controller
{

    /**
     * record
     *enregistrer un nouveau post
     * @return void
     */
    public static function record()
    {

        try {
            $controlled_array = self::Control_array();
            $post = new PostEntity($controlled_array);
            $posts = new PostsManager;
            $posts->create($post);
            $redir = 'location: /admin';
            return header($redir);
        } catch (Exception $e) {
            $affiche = new MessageController;
            $affiche->message($e->getMessage());
        }
    }

    /**
     * all
     *recherche tous les posts
     * 
     * @return void
     */
    public static function all()
    {
        try {
            $posts = new PostsManager;
            self::global();
            self::view(self::getTwig()->render('article/all.html', [
                'posts' => $posts->readAll(),
                'global' => self::$global,
            ]));
        } catch (Exception $e) {
            $affiche = new MessageController;
            $affiche->message($e->getMessage());
        }
    }
    /**
     * one
     *
     * chercher le post de l'id passé en param
     * et genere le page one.htlm
     * 
     * @param  mixed $id
     * @return void
     */
    public static function one(int $id)
    {
        try {
            $post = new PostsManager;
            $id = self::valid_data($id);
            $comments = new CommentsManager;
            $session = new Session;
            $auth = $session::get('auth');
            if (isset($auth)) {
                $connect = true;
            } else {
                $connect = false;
            }
            self::global();
            self::view(self::getTwig()->render('article/one.html', [
                'post' => $post->readOne($id),
                'comments' => $comments->findAllValidedByPost($id),
                'auth' => $connect,
                'global' => self::$global,
            ]));
        } catch (Exception $e) {
            $affiche = new MessageController;
            $affiche->message($e->getMessage());
        }
    }

    /**
     * update
     *met à jour le post dont l'id est passé en $_POST
     * @return void
     */
    public static function update()
    {
        try {
            $posts = new PostsManager;
            $controlled_array = self::Control_array();
            $post = $posts->readOne($controlled_array['id']);
            $post->hydrate($controlled_array);
            $posts->update($post);
            $redir = 'location: /admin';
            return header($redir);
        } catch (Exception $e) {
            $affiche = new MessageController;
            $affiche->message($e->getMessage());
        }
    }

    /**
     * delete
     * supprime le post dont l'id est passé en parametre et tous ses commentaires
     * 
     * 
     * @param  mixed $id
     * @return 
     */
    public static function delete(int $id_post, $token)
    {
        try {
            $token = self::valid_data($token);
            if (!(isset($token) && ($token == $_SESSION['token']))) {
                throw new Exception('Token de session invalide');
            } 
            $id_post = self::valid_data($id_post);
            $posts = new PostsManager;
            $comments = new CommentsManager;
            $commentsOfPost = $comments->findAllByPost($id_post);
            foreach ($commentsOfPost as $comment) {
                $comments->delete($comment);
            }
            $post = $posts->readOne($id_post);
            $posts->delete($post);
            $redir = 'location: /admin';
            return header($redir);
        } catch (Exception $e) {
            $affiche = new MessageController;
            $affiche->message($e->getMessage());
        }
    }
}
