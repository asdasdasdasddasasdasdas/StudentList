<?php


namespace StudentList\helpers;


class CSRF
{
    /**
     * @var Cookies
     */
    private $cookies;

    /**
     * CSRF constructor.
     * @param Cookies $cookies
     */
    public function __construct(Cookies $cookies)
    {
        $this->cookies = $cookies;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function makeToken(): string
    {
        if ($this->cookies->issetCookie('token')) {
            $token = $this->cookies->getCookie('token');
            $this->cookies->setCookie('token', $token, time() + 3600);
        } else {
            $token = bin2hex(random_bytes(32));
            $this->cookies->setCookie('token', $token, time() + 3600);
        }
        return $token;
    }

    /**
     * @return array
     */
    public function checkToken($token)
    {

        if ($token !== $this->cookies->getCookie('token') || empty($token) || empty($this->cookies->getCookie('token'))) {
            return 'Ошибка';
        }
        return null;
    }


}