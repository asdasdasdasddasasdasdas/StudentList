<?php

namespace StudentList\exceptions;

use Exception;

class ControllerException extends Exception
{
    private $templatePath = '../app/view/404.php';

    public function __construct($code = 404)
    {
        $this->code = $code;
    }

    /**
     * @return string
     */
    public function getTemplatePath()
    {
        return $this->templatePath;
    }


}
