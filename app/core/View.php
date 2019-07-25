<?php


namespace StudentList\core;


class View
{
    public function render($path, $response, array $vars)
    {

        $body = $response->getBody();

        if (!$body->isWritable()) {
            throw new \RuntimeException('Response body must be writeable.');
        }
        ob_start();
        extract($vars, EXTR_SKIP);
        require_once "../app/view/layouts/def.php";
        $body->write(ob_get_clean());

        $response->withBody($body);
        return $response;
    }

}