<?php

namespace app\Controller;

abstract class Controller
{

    public function render($path, $params = [])
    {
        extract($params, EXTR_SKIP);
        require_once "../app/view/layouts/def.php";
    }

}
