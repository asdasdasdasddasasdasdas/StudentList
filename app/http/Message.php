<?php


namespace StudentList\http;


use Psr\Http\Message\MessageInterface;
use Psr\Http\Message\StreamInterface;

abstract class Message implements MessageInterface
{
    /**
     * @var array
     */
    protected $headers = [];
    /**
     * @var
     */
    protected $body;
    /**
     * @var string
     */
    protected $protocolVersion = "1.1";
    /**
     * @var array
     */
    protected $allowedProtocolVersions = ["1.0", "1.1"];

    /**
     * @return string
     */
    public function getProtocolVersion()
    {
        return $this->protocol;
    }

    /**
     * @param string $version
     * @return MessageInterface|Message
     */
    public function withProtocolVersion($version)
    {
        if (!in_array($this->allowedProtocolVersions, $version)) {
            throw new \InvalidArgumentException('Invalid protocol version');
        }
        $clone = clone $this;
        $clone->protocol = $version;
        return $clone;
    }

    /**
     * @return array|\string[][]
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * @param string $name
     * @return mixed|string[]
     */
    public function getHeader($name)
    {
        return $this->headers[strtolower($name)];
    }

    /**
     * @return mixed
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * @param string $name
     * @return string|null
     */
    public function getHeaderLine($name)
    {
        $value = $this->getHeader($name);
        if (empty($value)) {
            return null;
        }
        return implode(',', $value);
    }

    /**
     * @param StreamInterface $body
     * @return MessageInterface|Message
     */
    public function withBody(StreamInterface $body)
    {
        $clone = clone $this;
        $clone->body = $body;
        return $clone;
    }

    /**
     * @param string $name
     * @param string|string[] $value
     * @return MessageInterface|Message
     */
    public function withHeader($name, $value)
    {
        $clone = clone $this;
        $clone->headers[strtolower($name)] = $value;
        return $clone;

    }

    /**
     * @param string $name
     * @return bool
     */
    public function hasHeader($name)
    {
        return array_key_exists(strtolower($name), $this->headers);
    }

    /**
     * @param string $name
     * @param string|string[] $value
     * @return MessageInterface|Message
     */
    public function withAddedHeader($name, $value)
    {

        $normalized = strtolower($name);
        $oldValues = $this->headers[$normalized];
        $clone = clone $this;
        $clone->headers[$normalized] = array_merge([$oldValues], [$value]);
        return $clone;
    }

    /**
     * @param string $name
     * @return MessageInterface|Message
     */
    public function withoutHeader($name)
    {

        if (!$this->hasHeader($name)) {
            return clone $this;
        }
        $normalized = strtolower($name);
        $clone = clone $this;
        unset($clone->headers[$normalized]);
        return $clone;
    }

    /**
     * @param $server
     * @return array
     */
    protected function filterHeaders($server)
    {
        $headers = [];
        foreach ($server as $key => $value) {
            if (strpos($key, 'REDIRECT_') === 0) {
                $key = substr($key, 9);
                if (array_key_exists($key, $server)) {
                    continue;
                }
            }
            if ($value === '') {
                continue;
            }
            if (strpos($key, 'HTTP_') === 0) {
                $name = strtr(strtolower(substr($key, 5)), '_', '-');
                $headers[$name] = $value;
                continue;
            }

        }
        return $headers;
    }

}