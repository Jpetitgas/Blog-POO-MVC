<?php

namespace App\Model;

class Animal 
{
     /**
     * @var string
     */
    private $attribute;

    /**
     * @return string
     */
    public function getAttribute()
    {
        return $this->attribute;
    }

   
}
