<?php
namespace app\controller;

abstract class Controller
{
  public function render($path,$params=[])
  {
    extract($params,EXTR_SKIP);

    require "app/view/layouts/def.php";
  }
}
