<?php

namespace App\Model\Entity;

use App\Model\Entity\Entity;

class PostEntity extends Entity{

    private $author;
    private $title;
    private $chapo;
    private $content;
    private $date_maj;
    private $authoruser;
 
    public function __construct(array $donnees){
      if (!empty($donnees))
    {
      $this->hydrate($donnees);
    }
    }
  // SETTERS //
  public function setAuthor($author)
  {
    $this->author = $author;
  }

  public function setTitle($title)
  {
    $this->title = $title;
  }

  public function setContent($content)
  {
    
    $this->content = $content;
  }

  public function setChapo($chapo)
  {
    $this->chapo = $chapo;
  }

  public function setDate_maj($date_maj)
  {
    $this->date_maj = $date_maj;
  }
  public function setAuthoruser($authoruser)
  {
    $this->authoruser = $authoruser;
  }
  
  // GETTERS //

  public function author()
  {
    return $this->author;
  }

  public function title()
  {
    return $this->title;
  }

  public function content()
  {
    return $this->content;
  }

  public function chapo()
  {
    return $this->chapo;
  }

  public function date_maj()
  {
    
    $date= date("d/m/Y", strtotime($this->date_maj));
    return  $date;
  }

  public function authoruser()
  {
    return $this->authoruser;
  }
  
}


