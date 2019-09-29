<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/29
 * Time: 15:47
 */

namespace Application\Web;

use \Exception;
use \SplFileObject;

/**
 * 使用PHP7中的增强功能提高性能
 *
 * Class Access
 * @package Application\Web
 */
class Access
{
    const ERROR_UNABLE = 'ERROR: unable to open file';

    protected $log;

    public $frequency = array();

    public function __construct ($filename)
    {
        if (!file_exists($filename)) {
            $message = __METHOD__ . ':' . self::ERROR_UNABLE . "\r\n";
            $message .= strip_tags($filename) . "\r\n";
            throw new Exception($message);
        }

        $this->log = new SplFileObject($filename, 'r');
    }

    /**
     * 定义一个生成器，以便逐行迭代这个日志文件
     *
     * @return int $count 行数
     */
    public function fileIteratorByLine()
    {
        $count = 0;
        while (!$this->log->eof()) {
            yield $this->log->fgets();
            $count ++;
        }
        return $count;
    }


    /**
     * 匹配IP地址，返回IP地址
     * @param $line
     * @return string
     */
    public function getIp($line)
    {
        preg_match('/(\d{1,3}\.\d{1,3}\.\d{1,3})/', $line, $match);

        // ip2long()
        return $match[1] ?? '';
    }



}