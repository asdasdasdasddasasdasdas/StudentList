<?php

namespace StudentList\exceptions;

use Exception;

class DIContainerException extends Exception
{
    public function __construct($name)
    {
        http_response_code(500);
        error_log('Такого названия как : ' . $name . ';<br> не существует.', 0);
        echo 'Такого названия как : ' . $name . ';<br> не существует.';
        die();
    }
}
