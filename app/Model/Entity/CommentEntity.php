<?php

namespace App\Model\Entity;

use App\Model\Entity\Entity;

class CommentEntity extends Entity
{

  private $id_post;
  private $comment;
  private $valided;
  private $id_user;
  private $author;
  private $post;
  private $date;


  public function __construct(array $donnees)
  {
    if (!empty($donnees)) {
      $this->hydrate($donnees);
    }
  }

  // SETTERS //
  public function setId_post($id_post)
  {

    $this->id_post = (int) $id_post;
  }

  public function setComment($comment)
  {
    if (!is_string($comment) || empty($comment)) {
    }
    $this->comment = $comment;
  }
  public function setValided($valided)
  {

    $this->valided = $valided;
  }
  public function setId_author($id_user)
  {
    $this->id_user =(int) $id_user;
  }
  
  public function setAuthor($author)
  {
    $this->author = $author;
  }
  public function setPost($post)
  {
    $this->post = $post;
  }
  public function setDate($date)
  {
    $this->date = $date;
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
  public function id_user()
  {
    return $this->id_user;
  }
  public function author()
  {
    return $this->author;
  }
  public function post()
  {
    return $this->post;
  }
  public function date()
  {
    $date= date("d/m/Y", strtotime($this->date));
    return  $date;
  }
}
