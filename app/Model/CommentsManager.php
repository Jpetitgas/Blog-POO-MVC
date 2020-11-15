<?php

namespace App\Model;

use App\Model\Entity\commentEntity;

class CommentsManager extends Manager
{
    
    /**
    * Enregistre d'un comment 
    */
    public function store(commentEntity $comment) {

        $query = 'INSERT INTO comment( id_post, comment, id_author ) VALUES (:id_post, :comment, :id_author)';
        $response = self::getPdo()->prepare($query);
        $response->execute([
            'id_post' => $comment->id_post(),
            'comment' => $comment->comment(),
            'id_author'=>'1',
        ]);

        return true;
    }
    
    /** 
    * Retourne la liste des comments 
    */ 
    public function findAll(int $valided) {
        if ($valided==1 | $valided==0){
            $query = "SELECT * FROM comment where valided=$valided";
            $response = self::getPdo()->prepare($query);
            $response->execute();

            $allcomments = $response->fetchAll();
            
            $objects=$this->arrayToObject($allcomments, 'comment');
            return $objects;
        }
       
    }
    /**
     * Retourne la liste des comments  validés d'un post
     */
    public function findAllValidedByPost(int $id) {
               
        $query = "SELECT * FROM comment where valided= '1' and id_post= ?";
        $response = self::getPdo()->prepare($query);
        $response->execute(array($id));

        $allcomments = $response->fetchAll();
        
        $objects=$this->arrayToObject($allcomments, 'comment');
        return $objects;
    }
    
    /**
     * Retourne la liste des comments d'un post
     */
    public function findAllByPost(int $id) {
               
        $query = "SELECT * FROM comment where id_post= ?";
        $response = self::getPdo()->prepare($query);
        $response->execute(array($id));

        $allcomments = $response->fetchAll();
        
        $objects=$this->arrayToObject($allcomments, 'comment');
        return $objects;
    }
    /**
    * Retourne un comment
    */
    public function readOne(int $id)
        {                     
            $query = "SELECT * FROM comment WHERE id= ?";
            $response = self::getPdo()->prepare($query);
            $response->execute(array($id));
            $data = $response->fetch();
            $post =new CommentEntity($data);
            return $post; 
        }
        /**
    * valide un comment
    */
    public function update(CommentEntity $comment)
    {
        $query=("UPDATE comment SET valided= '1' WHERE id = :id ");
        $response=self::getPdo()->prepare($query);
        $response->execute([
            'id'=>$comment->id(),
            
        ]);   
    }
    
    /** 
    *supprime un comment
    */
    public function delete(CommentEntity $comment)
    {
        $query = "DELETE FROM comment WHERE id= ?";
        $response = self::getPdo()->prepare($query);
        $id=array($comment->id());
        $response->execute($id);
    }
}


