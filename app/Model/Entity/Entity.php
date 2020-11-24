<?php

namespace App\Model\Entity;
 
class Entity {
  
  protected $id;
 
    
  public function id()
  {
    return $this->id;
  }
 
  public function setId(int $id)
  {
    $this->id = $id;
  }
   
  /**
   * hydrate
   * 
   * @param  array $donnees
   * @return void
   */
  public function hydrate(array $donnees)
  {
    foreach ($donnees as $attribut => $valeur)
    {
      
      $methode = 'set'.ucfirst($attribut);
 
      if (is_callable([$this, $methode]))
      {
        $this->$methode($valeur);
      }
    }
  }
  
  
}