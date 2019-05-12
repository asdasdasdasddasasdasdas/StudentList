<?php

namespace StudentList\exceptions;

use Exception;

class ControllerException extends Exception
{
    public function __construct()
    {
        http_response_code(404);
    }

    public function get404($action): void
    {
        $path = '../app/view/404.php';
        require '../app/view/layouts/def.php';
        die();
    }


}
