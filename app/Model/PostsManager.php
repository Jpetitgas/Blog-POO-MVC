<?php

namespace App\Model;

use App\Model\Entity\PostEntity;

class PostsManager extends Manager
{
    /**
    * Enregistre un article
    */
    public function create(PostEntity $post) {

        $query = 'INSERT INTO post(title, chapo, content, author,date_maj) VALUES (:title, :chapo, :content, :author, :date_maj)';
        $response = self::getPdo()->prepare($query);
            
        $response->execute([
            'title' => $post->title(),
            'chapo' => $post->chapo(),
            'content' => $post->content(),
            'author' => '1',
            'date_maj' =>date('d.m.Y'),

        ]);

        return true;
    }

    /**
     * Retourne tous les articles
     */
    public function readAll() {
        
        $query = "SELECT * FROM post order by id";
        $response =self::getPdo()->prepare($query);
        $response->execute();
        $allposts = $response->fetchAll();
        $objects=$this->arrayToObject($allposts, 'post');
        return $objects;
    }
    
    /**
         * Retourne un article
         */
        public function readOne(int $id)
        {                     
            $query = "SELECT * FROM post WHERE id= ?";
            $response = self::getPdo()->prepare($query);
            $response->execute(array($id));
            $data = $response->fetch();
            if (!$data){
                header('location: /404');
                die();
            }
            $post =new PostEntity($data);
            return $post; 
        }
    /**
    * Met à jour un article
    */
    public function update(PostEntity $post)
        {
            $query=("UPDATE post SET title= :title, chapo= :chapo, content= :content , author= :author, date_maj= :date_maj WHERE id = :id ");
            $response=self::getPdo()->prepare($query);
            $response->execute([
                'title' => $post->title(),
                'chapo' => $post->chapo(),
                'content' => $post->content(),
                'author' => '1',
                'date_maj'=> date('d.m.Y'),
                'id'=>$post->id(),
                
            ]);   
        }
    
        /**
    * supprime un article
    */
    public function delete(PostEntity $post)
        {
            $query = "DELETE FROM post WHERE id= ?";
            $response = self::getPdo()->prepare($query);
            $id=array($post->id());
            
            $response->execute($id);
        }

        


    



}
