<?php


namespace StudentList\http;


use Psr\Http\Message\UriInterface;

class Uri implements UriInterface
{
    /**
     * @var string
     */
    private $scheme;
    /**
     * @var string
     */
    private $userInfo;
    /**
     * @var string
     */
    private $host;
    /**
     * @var |null
     */
    private $port;
    /**
     * @var string
     */
    private $path;
    /**
     * @var string
     */
    private $query;
    /**
     * @var string
     */
    private $fragment;

    /**
     * Uri constructor.
     * @param $scheme
     * @param $authority
     * @param $userInfo
     * @param $host
     * @param $port
     * @param $path
     * @param $query
     * @param $fragment
     */
    public function __construct($uri)
    {
        $parsed_url = parse_url($uri);
        $this->scheme = isset($parsed_url['scheme']) ? $parsed_url['scheme'] : '';
        $this->userInfo = isset($parsed_url['user']) ? $parsed_url['user'] : '';
        $this->host = isset($parsed_url['host']) ? $parsed_url['host'] : '';
        $this->port = isset($parsed_url['port']) ? $parsed_url['port'] : null;
        $this->path = isset($parsed_url['path']) ? $parsed_url['path'] : '';
        $this->query = isset($parsed_url['query']) ? $parsed_url['query'] : '';
        $this->fragment = isset($parsed_url['fragment']) ? $parsed_url['fragment'] : '';
    }

    /**
     * @return string
     */
    public function getScheme()
    {
        return $this->scheme;
    }

    /**
     * @return string
     */
    public function getUserInfo()
    {
        return $this->userInfo;
    }

    /**
     * @return string
     */
    public function getHost()
    {
        return $this->host;
    }

    /**
     * @return |null
     */
    public function getPort()
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function getQuery()
    {
        return $this->query;
    }

    /**
     * @return string
     */
    public function getFragment()
    {
        return $this->fragment;
    }

    /**
     * @param string $scheme
     * @return UriInterface|Uri
     */
    public function withScheme($scheme)
    {
        $clone = clone $this;
        $clone->scheme = strtolower($scheme);
        return $clone;
    }

    /**
     * @param string $user
     * @param null $password
     * @return UriInterface|Uri
     */
    public function withUserInfo($user, $password = null)
    {
        $clone = clone $this;
        $clone->userInfo = strtolower($user);
        return $clone;
    }

    /**
     * @param string $host
     * @return UriInterface|Uri
     */
    public function withHost($host)
    {
        $clone = clone $this;
        $clone->host = strtolower($host);
        return $clone;
    }

    /**
     * @param int|null $port
     * @return UriInterface|Uri
     */
    public function withPort($port)
    {
        $clone = clone $this;
        $clone->port = $port;
        return $clone;
    }

    /**
     * @param string $path
     * @return UriInterface|Uri
     */
    public function withPath($path)
    {
        $clone = clone $this;
        $clone->path = $path;
        return $clone;
    }

    /**
     * @return string
     */
    public function getAuthority()
    {
        if ('' === $this->host) {
            return '';
        }
        $authority = $this->host;
        if ('' !== $this->userInfo) {
            $authority = $this->userInfo . '@' . $authority;
        }
        return $authority;
    }

    /**
     * @param string $query
     * @return UriInterface|Uri
     */
    public function withQuery($query)
    {
        $clone = clone $this;
        $clone->query = $query;
        return $clone;
    }

    /**
     * @param string $fragment
     * @return UriInterface|Uri
     */
    public function withFragment($fragment)
    {
        $clone = clone $this;
        $this->fragment = $fragment;
        return $clone;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        $uri = '';
        $authority = $this->getAuthority();
        if ('' !== $this->scheme) {
            $uri .= sprintf('%s:', $this->scheme);
        }
        if ('' !== $authority) {
            $uri .= '//' . $authority;
        }
        $uri .= $this->path;
        if ('' !== $this->query) {
            $uri .= sprintf('?%s', $this->query);
        }
        if ('' !== $this->fragment) {
            $uri .= sprintf('#%s', $this->fragment);
        }
        return $uri;

    }

}