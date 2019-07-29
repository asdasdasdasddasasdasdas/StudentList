<?php


namespace StudentList\http;


use Psr\Http\Message\StreamInterface;

/**
 * Class Stream
 * @package StudentList\http
 */
class Stream implements StreamInterface
{
    /**
     * @var
     */
    protected $resource;

    /**
     * @var
     */
    protected $stream;

    /**
     * Stream constructor.
     * @param $stream
     * @param string $mode
     */
    public function __construct($stream, string $mode = 'r')
    {
        $this->setStream($stream, $mode);
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if (!$this->isReadable()) {
            return '';
        }
        try {
            if ($this->isSeekable()) {
                $this->rewind();

                return $this->getContents();
            }
        } catch (\RuntimeException $e) {
            return '';
        }

    }

    /**
     *
     */
    public function close(): void
    {
        if (!$this->resource) {
            return;
        }
        $resource = $this->detach();
        fclose($resource);
    }

    /**
     * @return resource|null
     */
    public function detach()
    {
        $resource = $this->resource;
        $this->resource = null;
        return $resource;
    }

    /**
     * @param $resource
     * @param string $mode
     */
    public function attach($resource, string $mode = 'r'): void
    {
        $this->setStream($resource, $mode);
    }

    /**
     * @return int|null
     */
    public function getSize(): ?int
    {
        if (null === $this->resource) {
            return null;
        }
        $stats = fstat($this->resource);
        if ($stats !== false) {
            return $stats['size'];
        }
        return null;
    }

    /**
     * @return int
     */
    public function tell(): int
    {

        if (!$this->resource) {
            throw new \RuntimeException('No resource available; cannot tell position');
        }
        $result = ftell($this->resource);
        if (!is_int($result)) {
            throw new \RuntimeException('Error occurred during tell operation');
        }
        return $result;
    }

    /**
     * @return bool
     */
    public function eof(): bool
    {
        if (!$this->resource) {
            return true;
        }
        return feof($this->resource);
    }

    /**
     * @return bool
     */
    public function isSeekable(): bool
    {
        if (!$this->resource) {
            return false;
        }
        $meta = stream_get_meta_data($this->resource);
        return $meta['seekable'];
    }

    /**
     * @param int $offset
     * @param int $whence
     * @return bool
     */
    public function seek($offset, $whence = SEEK_SET)
    {
        if (!$this->resource) {
            throw new \RuntimeException('No resource available; cannot seek position');
        }

        if (!$this->isSeekable()) {
            throw new \RuntimeException('Stream is not seekable');
        }
        $result = fseek($this->resource, $offset, $whence);
        if (0 !== $result) {
            throw new \RuntimeException('Error seeking within stream');
        }
        return true;

    }

    /**
     *
     */
    public function rewind(): void
    {
        $this->seek(0);
    }

    /**
     * @return bool
     */
    public function isWritable(): bool
    {
        if (!$this->resource) {
            return false;
        }
        $meta = stream_get_meta_data($this->resource);
        $mode = $meta['mode'];
        return (
            strstr($mode, 'x')
            || strstr($mode, 'w')
            || strstr($mode, 'c')
            || strstr($mode, 'a')
            || strstr($mode, '+')
        );
    }

    /**
     * @param string $string
     * @return int
     */
    public function write($string): int
    {

        if (!$this->resource) {
            throw new \RuntimeException('No resource available; cannot write');
        }
        $result = fwrite($this->resource, $string);
        if (false === $result) {
            throw new \RuntimeException('Error writing to stream');
        }
        return $result;
    }

    /**
     * @return bool
     */
    public function isReadable(): bool
    {
        if (!$this->resource) {
            return false;
        }
        $meta = stream_get_meta_data($this->resource);
        $mode = $meta['mode'];
        return (strstr($mode, 'r') || strstr($mode, '+'));
    }

    /**
     * @param int $length
     * @return string
     */
    public function read($length): string
    {

        if (!$this->resource) {
            throw new \RuntimeException('No resource available; cannot read');
        }
        if (!$this->isReadable()) {
            throw new \RuntimeException('Stream is not readable');
        }
        $result = fread($this->resource, $length);
        if (false === $result) {
            throw new \RuntimeException('Error reading stream');
        }
        return $result;
    }

    /**
     * @return string
     */
    public function getContents(): string
    {

        $result = stream_get_contents($this->resource);
        if (false === $result) {
            throw new \RuntimeException('Error reading from stream');
        }
        return $result;
    }

    /**
     * @param null $key
     * @return array|mixed|null
     */
    public function getMetadata($key = null)
    {
        if (null === $key) {
            return stream_get_meta_data($this->resource);
        }
        $metadata = stream_get_meta_data($this->resource);
        if (!array_key_exists($key, $metadata)) {
            return null;
        }
        return $metadata[$key];
    }

    /**
     * @param $stream
     * @param string $mode
     */
    private function setStream($stream, string $mode = 'r'): void
    {
        $error = null;
        $resource = $stream;
        if (is_string($stream)) {
            $resource = fopen($stream, $mode);
        }

        if ($stream !== $resource) {
            $this->stream = $stream;
        }
        $this->resource = $resource;
    }
}