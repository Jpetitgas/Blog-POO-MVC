<?php

namespace App\Model;

use App\Model\Entity\PostEntity;

class PostsManager extends Manager
{    
    /**
     * create
     * Enregistre un article
     * @param  mixed $post
     * @return void
     */
    public function create(PostEntity $post)
    {

        $query = 'INSERT INTO post(title, chapo, content, author,date_maj) VALUES (:title, :chapo, :content, :author, :date_maj)';
        $response = self::getPdo()->prepare($query);

        $response->execute([
            'title' => $post->title(),
            'chapo' => $post->chapo(),
            'content' => $post->content(),
            'author' => $_SESSION['auth'],
            'date_maj' => $this->getFormattedDateTime(),

        ]);

        return true;
    }

        
    /**
     * readAll
     * Retourne tous les articles
     * @return void
     */
    public function readAll()
    {

        $query = "SELECT post.id, post.title, post.chapo, post.content, post.author, post.date, post.date_maj, user.username as authoruser
        FROM post
        INNER JOIN user ON post.author = user.id 
        order by post.date_maj desc";
        $response = self::getPdo()->prepare($query);
        $response->execute();
        $allposts = $response->fetchAll();
        $objects = $this->arrayToObject($allposts, 'post');
        return $objects;
    }

        
    /**
     * readOne
     * Retourne un article en fonction de l'id passé en parametre
     * @param  mixed $id
     * @return object
     */
    public function readOne(int $id)
    {
        $query = "SELECT post.id, post.title, post.chapo, post.content, post.author, post.date, post.date_maj, user.username as authoruser
        FROM post
        INNER JOIN user ON post.author = user.id  
        WHERE post.id= ?";
        $response = self::getPdo()->prepare($query);
        $response->execute(array($id));
        $data = $response->fetch();
        if (!$data) {
            header('location: /404');
            die();
        }
        $post = new PostEntity($data);
        return $post;
    }
    
    
        
    /**
     * update
     * Met à jour un article
     * @param  mixed $post
     * @return void
     */
    public function update(PostEntity $post)
    {
        $query = ("UPDATE post SET title= :title, chapo= :chapo, content= :content , author= :author, date_maj= :date_maj WHERE id = :id ");
        $response = self::getPdo()->prepare($query);
        $response->execute([
            'title' => $post->title(),
            'chapo' => $post->chapo(),
            'content' => $post->content(),
            'author' => $_SESSION['auth'],
            'date_maj' => $this->getFormattedDateTime(),
            'id' => $post->id(),

        ]);
    }

       
    /**
     * delete
     *supprime un article
     * @param  mixed $post
     * @return object
     */
    public function delete(PostEntity $post)
    {
        $query = "DELETE FROM post WHERE id= ?";
        $response = self::getPdo()->prepare($query);
        $id = array($post->id());

        $response->execute($id);
    }
}
