<?php


namespace StudentList\core;

use Psr\Http\Message\ResponseInterface;
use StudentList\http\Response;
use StudentList\http\Stream;

class App
{
    /**
     * @var
     */
    private $router;

    /**
     * @var
     */
    private $di;

    /**
     * App constructor.
     * @param $router
     * @param $di
     */
    public function __construct($router, $di)
    {
        $this->di = $di;
        $this->router = $router;

    }

    /**
     * @param $request
     * @param $response
     */
    public function start($request, $response)
    {
        set_exception_handler([$this, 'exceptionHandler']);
        $response = $this->router->run($request, $response);
        $this->send($response);
    }

    /**
     * @param ResponseInterface $response
     */
    public function send(ResponseInterface $response)
    {
        if (!headers_sent()) {
            $reasonPhrase = $response->getReasonPhrase();
            $headers = $response->getHeaders();

            header(sprintf(
                'HTTP/%s %d %s',
                $response->getProtocolVersion(),
                $response->getStatusCode(),
                ($reasonPhrase ? ' ' . $reasonPhrase : '')));

            foreach ($headers as $header => $value) {
                header(sprintf("%s: %s", $header, $value), false);
            }
        }

        echo $response->getBody();
    }

    /**
     * @param $e
     */
    public function exceptionHandler($e)
    {
        $response = new Response(new Stream(fopen('php://temp', 'w+')), $e->getCode(), $_SERVER);

        if (method_exists($e, 'getTemplatePath')) {
            $path = $e->getTemplatePath();

        } else {

            $path = '../app/view/error.php';

        }
        ob_start();
        extract(['e' => $e]);

        require '../app/view/layouts/def.php';
        $body = $response->getBody();
        $body->write(ob_get_clean());
        $response->withBody($body);

        $this->send($response);
    }
}