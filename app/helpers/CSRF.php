<?php


namespace StudentList\helpers;


class CSRF
{
    /**
     * @var Cookies
     */
    private $token;

    public function getToken()
    {
        return $this->token;
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function makeToken($response, $token)
    {
        if (!is_null($token)) {

            $this->token = $token;
            $d = time();
            return $response = $response->withHeader('Set-Cookie', "token={$token}; Max-Age={$d} + 60 * 60");
        } else {
            $d = time();
            $token = $this->generateToken();

            return $response = $response->withHeader('Set-Cookie', "token={$token}; Max-Age={$d} + 3600");
        }
    }


    private function generateToken()
    {
        $token = bin2hex(random_bytes(32));
        $this->token = $token;
        return $token;
    }

    /**
     * @return array
     */
    public function checkToken($token, $cookieToken)
    {

        if ($token !== $cookieToken || empty($token) || empty($cookieToken)) {
            return 'Ошибка';
        }
        return null;
    }


}