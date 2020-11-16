<?php

namespace App\Model\Entity;

use App\Model\Entity\Entity;

class CommentEntity extends Entity{
 
  private   $id_post;
  private   $comment;
  private   $valided;
  
  public function __construct(array $donnees){
    if (!empty($donnees))
  {
    $this->hydrate($donnees);
  }
  }
  
  // SETTERS //
  public function setId_post($id_post)
  {
    
    $this->id_post =(int) $id_post;
  }

  public function setComment($comment)
  {
    if (!is_string($comment) || empty($comment))
    {
      
    }
    $this->comment = $comment;
  }
  public function setValided($valided)
  {
    
    $this->valided = $valided;
  }

   // GETTERS //

  public function id_post()
  {
    return $this->id_post;
  }

  public function comment()
  {
    return $this->comment;
  }

  public function valided()
  {
    return $this->valided;
  }

  
}


