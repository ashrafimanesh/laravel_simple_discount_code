<?php
/**
 * Created by PhpStorm.
 * User: ashrafimanesh@gmail.com
 * Date: 3/13/20
 * Time: 6:53 PM
 */

namespace App\Exceptions;


class ValidationCustomException extends \Exception
{
    public $errors = [];

    public function addError($error){
        $this->errors[] = $error;
        return $this;
    }

    public function errors(){
        return $this->errors;
    }
}