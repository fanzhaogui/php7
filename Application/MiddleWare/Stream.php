<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/12/27
 * Time: 17:19
 */

namespace Application\MiddleWare;

use PHPUnit\DbUnit\RuntimeException;
use Psr\Http\Message\StreamInterface;
use \SplFileInfo;

class Stream extends Constants implements StreamInterface
{
    /**
     * @var bool|resource
     */
    protected $stream;

    protected $metadata;

    protected $info;



    public function __construct($input, $mode = self::MODE_READ)
    {
        $this->stream = fopen($input, $mode);
        $this->metadata = stream_get_meta_data($this->stream);
        $this->info = new SplFileInfo($input);
    }


    public function getStream()
    {
        return $this->stream;
    }

    public function getInfo()
    {
        return $this->info;
    }

    public function read($length)
    {
        if (!fread($this->stream, $length)) {
            throw new RuntimeException(self::ERROR_BAD . __METHOD__);
        }
    }

    public function write($string)
    {
        if (!fwrite($this->stream, $string)) {
            throw new RuntimeException(self::ERROR_BAD . __METHOD__);
        }
    }

    public function rewind()
    {
        if (!rewind($this->stream)) {
            throw new RuntimeException(self::ERROR_BAD . __METHOD__);
        }
    }

    public function eof ()
    {
        return eof($this->stream);
    }

    public function tell()
    {
        try {
            return ftell($this->stream);
        } catch (\Throwable $e) {
            throw new RuntimeException(self::ERROR_BAD . __METHOD__);
        }
    }

    public function seek($offset, $whence = SEEK_SET)
    {
        try {
            fseek($this->stream, $offset, $whence);
        } catch (\Throwable $e) {
            throw new RuntimeException(self::ERROR_BAD . __METHOD__);
        }
    }

    public function close()
    {
        if ($this->stream) {
            fclose($this->stream);
        }
    }

    public function detach()
    {
        return $this->close();
    }

    public function getMetadata($key = null)
    {
        if ($key) {
            return $this->metadata[$key] ?? null;
        } else {
            return $this->metadata;
        }
    }


    public function getSize()
    {
        return $this->info->getSize();
    }

    public function isSeekable()
    {
        return boolval($this->metadata['seekable']);
    }

    public function isWritable()
    {
        return $this->stream->isWritable();
    }

    public function isReadable()
    {
        return $this->info->isReadable();
    }

    public function __toString()
    {
        $this->rewind();
        return $this->getContents();
    }

    // 获取 数据流中的数据
    public function getContents()
    {
        ob_start();
        if (!fpassthru($this->stream)) {
            throw new RuntimeException(self::ERROR_BAD . __METHOD__);
        }
        return ob_get_clean();
    }
}