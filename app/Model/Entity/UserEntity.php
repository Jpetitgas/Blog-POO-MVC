<?php

namespace App\Model\Entity;

use App\Model\Entity\Entity;

class UserEntity extends Entity{

  private $username;
  private $email;
  private $password;
  private $valided;
  private $role;
  
  public function __construct(array $donnees){
    if (!empty($donnees))
  {
    $this->hydrate($donnees);
  }
  }

  // SETTERS //
  public function setUsername($username)
  {
   
    $this->username = $username;
  }

  public function setEmail($email)
  {
    
    $this->email = $email;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function setValided($valided)
  {
    $this->valided =(int) $valided;
  }
  public function setRole($role)
  {
    $this->role =(int) $role;
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
  public function role()
  {
    return $this->role;
  }


 }


