<?php
/**
 * User: Andy
 * Date: 2019/12/4
 * Time: 22:34
 */

namespace Application\Iterator;

use \RecursiveIteratorIterator;
use \RecursiveDirectoryIterator;
use \Exception;
use \RegexIterator;
use \RecursiveRegexIterator;
use SebastianBergmann\CodeCoverage\Report\PHP;

class Directory
{
    const ERROR_UNABLE = 'ERROR: UNable to read directory!';

    protected $patch;

    protected $rdi;

    public function __construct($path)
    {
        try {
            $this->rdi = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($path),
                RecursiveIteratorIterator::SELF_FIRST
            );
        } catch (\Throwable $e) {
            $message = __METHOD__ . ' : ' . self::ERROR_UNABLE . PHP_EOL;
            $message .= strip_tags($path) . PHP_EOL;
            echo $message;
            exit();
        }
    }

    // 模仿 linux 中  ls -l  -R 命令的输出结果
    // 可使用 yield 关键字高效地将这个方法变成生成器 Generator

    public function ls($pattern = NULL)
    {
        $outIterator = ($pattern) ? $this->regex($this->rdi, $pattern) : $this->rdi;

        foreach ($outIterator as $obj) {
            /**@var $obj \SplFileInfo */
            if ($obj->isDir()) {
                if ($obj->getFilename() == '..') {
                    continue;
                }
                $line = $obj->getPath() . PHP_EOL;
            } else {
                $line =
                    $obj->getPerms() . ' '.
                    $obj->getType() . ' '.
                    $obj->getOwner().' '.
                    $obj->getGroup() .' '.
                    $obj->getSize() .' '.
                    date('Y-m-d H:i:s', $obj->getATime()) .' '.
                    $obj->getFilename() . PHP_EOL;
            }
            yield $line;
        }
    }

    // dir
    public function dir($pattern = NULL)
    {
        $outIterator = ($pattern) ? $this->regex($this->rdi, $pattern) : $this->rdi;

        foreach ($outIterator as $name => $obj) {
            yield $name . PHP_EOL;
        }
    }




    protected function regex($iterator, $pattern)
    {
        $pattern = '!^.' . str_replace('.' , '\\.', $pattern) . '$!';
        return new RegexIterator($iterator, $pattern);
    }
}