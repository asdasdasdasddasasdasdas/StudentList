<?php

namespace StudentList\core;


abstract class Controller
{

    public function execute($action, $request, $response)
    {
        $this->$action($request, $response);
    }
}
