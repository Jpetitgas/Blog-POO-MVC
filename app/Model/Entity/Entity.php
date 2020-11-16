<?php

namespace App\Model\Entity;
 
abstract class Entity {
  
  protected $id;
 
    
  public function id()
  {
    return $this->id;
  }
 
  public function setId($id)
  {
    $this->id = (int) $id;
  }
 
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
  
  private function valid_data($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
  
}