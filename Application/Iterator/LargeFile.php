<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/12/2
 * Time: 16:26
 */

namespace Application\Iterator;
use \Exception;
use SebastianBergmann\CodeCoverage\Report\PHP;

/**
 * 读取大文件
 * @package Application\Iterator
 */
class LargeFile
{
    const ERROR_UNABLE = 'ERROR: Unable to open file';
    const ERROR_TYPE = 'ERROR: Type must be "ByLength". "ByLine",or "CSV';

    protected $file;

    protected $allowedType = ['ByLine', 'ByLength', 'Csv'];

    public function __construct($filename, $mode = 'r')
    {
        if (!file_exists($filename)) {
            $message = __METHOD__ . ' : ' . self::ERROR_UNABLE . PHP_EOL;
            $message .= strip_tags($filename);
            throw new Exception($message);
        }

        $this->file = new \SplFileObject($filename, $mode);
    }

    /**
     * @desc 公告fgets()函数每次从要处理的文件中读取一行内容。
     * 也可以创建 fileIteratorByLength()方法，该方法会执行相同的操作，
     * 但会用fread()函数代替fgets()函数。
     * 1. 使用fgets()函数的方法适合于处理含有换行符的文本文件
     * 2. 使用 fread()函数的方法适合处理较大的二进制文件
     */
    public function fileIteratorByLine()
    {
        $count = 0;
        while (!$this->file->eof()) {
            yield $this->file->fgets(); // 读取一行内容
            $count ++;
        }
        return $count;
    }

    /**
     * 读取指定长度的文件内容
     *
     * @param int $numByte 一次读取的长度
     */
    public function fileIteratorByLength($numByte = 1024)
    {
        $count = 0;
        while (!$this->file->eof()) {
            yield $this->file->fread($numByte); // 读取长度为$numByte的内容
            $count ++;
        }
        return $count;
    }


    /**
     *
     */
    public function getIterator ($type = 'ByLine', $numByte = null)
    {
        if (!in_array($type, $this->allowedType)) {
            $message = __METHOD__ . ' : ' . self::ERROR_TYPE . PHP_EOL;
            throw new \InvalidArgumentException($message);
        }

        $iterator = 'fileIterator' . $type;
        // 通过传入的类型参数，判断使用什么方式读取文件中的内容
        return new \NoRewindIterator($this->$iterator($numByte));
    }



    /**
     * 便利csv文件
     *
     */
    protected function fileIteratorCsv()
    {
       $count = 0;
       while (!$this->file->eof()) {
           yield $this->file->fgetcsv();
           $count ++;
       }
       return $count;
    }















}



