<?php

namespace app\exceptions;

use Exception;

class ControllerException extends Exception
{
    public function get404($action)
    {
        $path = '../app/view/404.php';
        require '../app/view/layouts/def.php';
        die();
    }


}
