<?php

namespace StudentList\core;


abstract class Controller
{


    /**
     * @param $path
     * @param array $params
     */


    public function render($path, $params = []): void
    {
        extract($params, EXTR_SKIP);
        require_once "../app/view/layouts/def.php";
    }

}
