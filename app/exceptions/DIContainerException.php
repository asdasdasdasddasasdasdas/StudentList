<?php

namespace StudentList\exceptions;

use Exception;

class DIContainerException extends Exception
{
    public function getMessage2($name)
    {
        echo 'Такого названия как : ' . $name . ';<br> не существует.';
        die();
    }
}
