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

  /**
   * setUsername
   *
   * @param  mixed $username
   * @return void
   */
  public function setUsername($username)
  {
   
    $this->username = $username;
  }
  
  /**
   * setEmail
   *
   * @param  mixed $email
   * @return void
   */
  public function setEmail($email)
  {
    
    $this->email = $email;
  }
  
  /**
   * setPassword
   *
   * @param  mixed $password
   * @return void
   */
  public function setPassword($password)
  {
    if (!is_string($password) || empty($password))
    {
      
    }
    $this->password = $password;
  }
  
  /**
   * setValided
   *
   * @param  mixed $valided
   * @return void
   */
  public function setValided($valided)
  {
    $this->valided =(int) $valided;
  }  
  /**
   * setRole
   *
   * @param  mixed $role
   * @return void
   */
  public function setRole($role)
  {
    $this->role =(int) $role;
  }

  /**
   * Username
   *
   * @return void
   */
  public function Username()
  {
    return $this->username;
  }
  
  /**
   * email
   *
   * @return void
   */
  public function email()
  {
    return $this->email;
  }
  
  /**
   * password
   *
   * @return void
   */
  public function password()
  {
    return $this->password;
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
   * role
   *
   * @return void
   */
  public function role()
  {
    return $this->role;
  }


 }


