<?php

namespace App\Model\Entity;

abstract class Entity
{

  protected $id;


  /**
   * id
   *
   * @return void
   */
  public function id()
  {
    return $this->id;
  }

  /**
   * setId
   *
   * @param  mixed $id
   * @return void
   */
  public function setId($id)
  {
    $this->id = (int) $id;
  }

  /**
   * hydrate
   * 
   * @param  array $donnees
   * @return void
   */
  public function hydrate(array $donnees)
  {
    foreach ($donnees as $attribut => $valeur) {
      $methode = 'set' . ucfirst($attribut);

      if (is_callable([$this, $methode])) {
        $this->$methode($valeur);
      }
    }
  }
}
