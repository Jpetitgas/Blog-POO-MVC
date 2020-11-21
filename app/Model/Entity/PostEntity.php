<?php

namespace App\Model\Entity;

use App\Model\Entity\Entity;

class PostEntity extends Entity
{

  private $author;
  private $title;
  private $chapo;
  private $content;
  private $date_maj;
  private $authoruser;

  public function __construct(array $donnees)
  {
    if (!empty($donnees)) {
      $this->hydrate($donnees);
    }
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
   * setTitle
   *
   * @param  mixed $title
   * @return void
   */
  public function setTitle($title)
  {
    $this->title = $title;
  }

  /**
   * setContent
   *
   * @param  mixed $content
   * @return void
   */
  public function setContent($content)
  {

    $this->content = $content;
  }

  /**
   * setChapo
   *
   * @param  mixed $chapo
   * @return void
   */
  public function setChapo($chapo)
  {
    $this->chapo = $chapo;
  }

  /**
   * setDate_maj
   *
   * @param  mixed $date_maj
   * @return void
   */
  public function setDate_maj($date_maj)
  {
    $this->date_maj = $date_maj;
  }
  /**
   * setAuthoruser
   *
   * @param  mixed $authoruser
   * @return void
   */
  public function setAuthoruser($authoruser)
  {
    $this->authoruser = $authoruser;
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
   * title
   *
   * @return void
   */
  public function title()
  {
    return $this->title;
  }

  /**
   * content
   *
   * @return void
   */
  public function content()
  {
    return $this->content;
  }

  /**
   * chapo
   *
   * @return void
   */
  public function chapo()
  {
    return $this->chapo;
  }

  /**
   * date_maj
   *
   * @return void
   */
  public function date_maj()
  {

    $date = date("d/m/Y", strtotime($this->date_maj));
    return  $date;
  }

  /**
   * authoruser
   *
   * @return void
   */
  public function authoruser()
  {
    return $this->authoruser;
  }
}
