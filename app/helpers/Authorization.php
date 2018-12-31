<?php
namespace app\Helpers;


class Authorization
 {

public function Cookie($hash)
{
  setcookie('hash', $hash, time()+60*60*24*365*10, "/", null, false,true);
}

public function checkHash()
{
  return isset($_COOKIE['hash']) ? $_COOKIE['hash'] : false;
}


}
