<?php

namespace StudentList\exceptions;

use Exception;

class DIContainerException extends Exception
{

    public function __construct($code,$message)
    {

       $this->code = $code;
       $this->message = $message;
    }
}
