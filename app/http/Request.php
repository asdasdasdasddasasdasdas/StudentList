<?php


namespace StudentList\http;

use StudentList\http\Message;
use Psr\Http\Message\StreamInterface;
use Psr\Http\Message\UriInterface;
use Psr\Http\Message\RequestInterface;

class Request extends Message implements RequestInterface
{
    /**
     * @var mixed
     */
    private $parsedBody;
    /**
     * @var mixed
     */
    private $queryParams;
    /**
     * @var
     */
    private $method;
    /**
     * @var mixed
     */
    private $uri;

    /**
     * @var string
     */
    private $requestTarget;

    /**
     * @var
     */
    private $cookieParams;
    /**
     * Request constructor.
     * @param mixed $parsedBody
     * @param mixed $queryParams
     * @param $method
     * @param mixed $uri
     * @param $serverParams
     */
    public function __construct($parsedBody, $queryParams, $method,UriInterface $uri,$headers, StreamInterface $body)
    {
        $this->parsedBody = $parsedBody;
        $this->queryParams = $queryParams;
        $this->method = $method;
        $this->uri = $uri;
        $this->headers = $headers;
        $this->body = $body;
        $this->requestTarget = $uri->getPath();

    }

    /**
     * @param $server
     * @return Request
     */
    static public function createFromGlobals($server) : RequestInterface
    {
        $uri = new Uri("http://studentlist{$server["REQUEST_URI"]}");
        $method = $server["REQUEST_METHOD"];
        $parsedBody = $_POST;
        $queryParams = $_GET;
        $body = new Stream(fopen('php://temp', 'w+'));
        $headers = self::filterHeaders($server);
        $request = new self($parsedBody, $queryParams, $method, $uri, $headers, $body);

        return $request;
    }

    /**
     * @return mixed
     */
    public function getMethod() : string
    {
        return $this->method;
    }

    /**
     * @return mixed
     */
    public function getUri() : UriInterface
    {
        return $this->uri;
    }

    /**
     * @return mixed
     */
    public function getParsedBody() : array
    {
        return $this->parsedBody;
    }

    /**
     * @return mixed
     */
    public function getQueryParams() : array
    {
        return $this->queryParams;
    }

    /**
     * @param string $method
     * @return RequestInterface|Request
     */
    public function withMethod($method) :array
    {
        $clone = clone $this;
        $clone->method = $method;
        return $clone;
    }

    /**
     * @param UriInterface $uri
     * @param bool $preserveHost
     * @return RequestInterface|Request
     */
    public function withUri(UriInterface $uri, $preserveHost = false)
    {
        $clone = clone $this;
        $clone->$uri = $uri;
        return $clone;
    }

    /**
     * @param mixed $requestTarget
     * @return RequestInterface|Request
     */
    public function withRequestTarget($requestTarget)
    {
        $clone = clone $this;
        $clone->requestTarget = $requestTarget;
        return $clone;
    }

    /**
     * @return string
     */
    public function getRequestTarget() : string
    {
        return $this->requestTarget;
    }
}