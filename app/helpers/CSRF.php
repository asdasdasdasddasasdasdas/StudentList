<?php


namespace StudentList\helpers;


class CSRF
{
    /**
     * @var
     */
    private $cookie;

    /**
     * CSRF constructor.
     * @param $Cookie
     */
    public function __construct($cookie)
    {
        $this->cookie = $cookie;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function makeToken(): string
    {
        if ($this->cookie->issetCookie('token')) {
            $token = $this->cookie->getCookie('token');
            $this->cookie->setCookie('token', $token, time() + 3600);
        } else {
            $token = bin2hex(random_bytes(32));
            $this->cookie->setCookie('token', $token, time() + 3600);
        }
        return $token;
    }

    /**
     * @return array
     */
    public function checkToken()
    {

        if ($_POST['token'] !== $this->cookie->getCookie('token') || empty($_POST['token']) || empty($this->cookie->getCookie('token'))) {
            return 'Ошибка';
        }
        return null;
    }


}