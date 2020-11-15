<?php

namespace App\Model\Entity;

use App\Model\Entity\Entity;

class User_MapEntity extends Entity{

  private $id_user;
  private $id_group;
  
  
  public function __construct(array $donnees = []){
    if (!empty($donnees))
  {
    $this->hydrate($donnees);
  }
  }

  // SETTERS //
  public function setId_user($id_user)
  {
    if (!is_string($id_user) || empty($id_user))
    {
      
    }
    $this->id_user = $id_user;
  }

  public function setId_group($id_group)
  {
    if (!is_string($id_group) || empty($id_group))
    {
      
    }
    $this->id_group = $id_group;
  }

  
  // GETTERS //

  public function id_user()
  {
    return $this->id_user;
  }

  public function id_group()
  {
    return $this->id_group;
  }

  

 }


