<?php

namespace App\Model;

use App\Model\Entity\CommentEntity;
use Exception;

class CommentsManager extends Manager
{
    protected static $bdd;

    function __construct()
    {
        $bdd = self::getPdo();
        if (!isset($bdd)) {
            throw new Exception("Impossible de se connecter à la base de données");
        }
        self::$bdd = $bdd;
    }
    /**
     * Enregistre d'un comment 
     */
    public function store(commentEntity $comment)
    {

        $query = 'INSERT INTO comment( id_post, comment, id_user ) VALUES (:id_post, :comment, :id_user)';
        $response = self::$bdd->prepare($query);
        $response->execute([
            'id_post' => $comment->id_post(),
            'comment' => $comment->comment(),
            'id_user' => $comment->id_user(),
        ]);

        return true;
    }

    /** 
     * Retourne la liste des comments 
     */
    public function findAll(int $valided)
    {
        if ($valided == 1 | $valided == 0) {
            $query = "SELECT comment.id, comment.id_user,comment.id_post, comment.comment, comment.valided, comment.date, user.username as author, post.title as post 
            FROM comment 
            INNER JOIN user ON comment.id_user = user.id 
            INNER JOIN post ON comment.id_post = post.id
            where comment.valided=$valided";
            $response = self::$bdd->prepare($query);
            $response->execute();

            $allcomments = $response->fetchAll();

            $objects = $this->arrayToObject($allcomments, 'comment');
            return $objects;
        }
    }
    /**
     * Retourne la liste des comments  validés d'un post
     */
    public function findAllValidedByPost(int $id_post)
    {

        $query = "SELECT comment.id, comment.id_user,comment.id_post, comment.comment, comment.valided, comment.date, user.username as author 
        FROM comment INNER JOIN user ON comment.id_user = user.id where comment.valided= '1' and id_post= ? ORDER BY comment.date DESC";
        $response = self::$bdd->prepare($query);
        $response->execute(array($id_post));

        $allcomments = $response->fetchAll();

        $objects = $this->arrayToObject($allcomments, 'comment');
        return $objects;
    }

    /**
     * Retourne la liste des comments d'un post
     */
    public function findAllByPost(int $id_post)
    {

        $query = "SELECT comment.id, comment.comment, user.username as author 
        FROM comment INNER JOIN user ON comment.id_user = user.id where id_post= ? ORDER BY comment.date DESC";
        $response = self::$bdd->prepare($query);
        $response->execute(array($id_post));

        $allcomments = $response->fetchAll();

        $objects = $this->arrayToObject($allcomments, 'comment');
        return $objects;
    }
    public function findAllByuser(int $id_user)
    {

        $query = "SELECT comment.id, comment.comment, user.username as author ,comment.id_user
        FROM comment INNER JOIN user ON comment.id_user = user.id where comment.id_user= ?";
        $response = self::$bdd->prepare($query);
        $response->execute(array($id_user));

        $allcomments = $response->fetchAll();

        $objects = $this->arrayToObject($allcomments, 'comment');
        return $objects;
    }
    /**
     * Retourne un comment
     */
    public function readOne(int $id_comment)
    {
        $query = "SELECT * FROM comment WHERE id= ?";
        $response = self::$bdd->prepare($query);
        $response->execute(array($id_comment));
        $data = $response->fetch();
        $post = new CommentEntity($data);
        return $post;
    }
    /**
     * valide un comment
     */
    public function update(CommentEntity $comment)
    {
        $query = ("UPDATE comment SET valided= '1' WHERE id = :id ");
        $response = self::$bdd->prepare($query);
        $response->execute([
            'id' => $comment->id(),

        ]);
    }

    /** 
     *supprime un comment
     */
    public function delete(CommentEntity $comment)
    {
        $query = "DELETE FROM comment WHERE id= ?";
        $response = self::$bdd->prepare($query);
        $id = array($comment->id());
        $response->execute($id);
    }
}
