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

  public function setId_post($id_post)
  {

    $this->id_post = (int) $id_post;
  }
  
  /**
   * setComment
   *
   * @param  mixed $comment
   * @return void
   */
  public function setComment($comment)
  {
    if (!is_string($comment) || empty($comment)) {
    }
    $this->comment = $comment;
  }  
  /**
   * setValided
   *
   * @param  mixed $valided
   * @return void
   */
  public function setValided($valided)
  {

    $this->valided = $valided;
  }  
  /**
   * setId_author
   *
   * @param  mixed $id_user
   * @return void
   */
  public function setId_author($id_user)
  {
    $this->id_user =(int) $id_user;
  }
    
  /**
   * setAuthor
   *
   * @param  mixed $author
   * @return void
   */
  public function setAuthor($author)
  {
    $this->author = $author;
  }  
  /**
   * setPost
   *
   * @param  mixed $post
   * @return void
   */
  public function setPost($post)
  {
    $this->post = $post;
  }  
  /**
   * setDate
   *
   * @param  mixed $date
   * @return void
   */
  public function setDate($date)
  {
    $this->date = $date;
  }

  /**
   * id_post
   *
   * @return void
   */
  public function id_post()
  {
    return $this->id_post;
  }
  
  /**
   * comment
   *
   * @return void
   */
  public function comment()
  {
    return $this->comment;
  }
  
  /**
   * valided
   *
   * @return void
   */
  public function valided()
  {
    return $this->valided;
  }  
  /**
   * id_user
   *
   * @return void
   */
  public function id_user()
  {
    return $this->id_user;
  }  
  /**
   * author
   *
   * @return void
   */
  public function author()
  {
    return $this->author;
  }  
  /**
   * post
   *
   * @return void
   */
  public function post()
  {
    return $this->post;
  }  
  /**
   * date
   *
   * @return void
   */
  public function date()
  {
    $date= date("d/m/Y", strtotime($this->date));
    return  $date;
  }
}
