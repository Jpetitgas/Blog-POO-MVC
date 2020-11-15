<?php

namespace App\Model\Entity;

use App\Model\Entity\Entity;

class UserEntity extends Entity{

  private $username;
  private $email;
  private $password;
  private $valided;
  
  public function __construct(array $donnees = []){
    if (!empty($donnees))
  {
    $this->hydrate($donnees);
  }
  }

  // SETTERS //
  public function setUsername($username)
  {
    if (!is_string($username) || empty($username))
    {
      
    }
    $this->username = $username;
  }

  public function setEmail($email)
  {
    if (!is_string($email) || empty($email))
    {
      
    }
    $this->email = $email;
  }

  public function setPassword($password)
  {
    if (!is_string($password) || empty($password))
    {
      
    }
    $this->password = $password;
  }

  public function setValided($valided)
  {
    $this->valided =(int) $valided;
  }

  // GETTERS //

  public function Username()
  {
    return $this->username;
  }

  public function email()
  {
    return $this->email;
  }

  public function password()
  {
    return $this->password;
  }

  public function valided()
  {
    return $this->valided;
  }

 }


