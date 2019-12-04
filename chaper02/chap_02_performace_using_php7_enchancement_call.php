<?php
/**
 * 原书本的内容，在处理多文件的时候，没看懂
 * 且输出的结果，也与最后贴出图案的内容不一致。
 *
 * User: fanzhaogui
 * Date: 2019/9/29
 * Time: 16:21
 */

define('LOG_FILES', '../logs/*error*.log');

require __DIR__ . '/../Application/Autoload/Loader.php';

use Application\Autoload\Loader;
use Application\Web\Access;

// add current directory to the path
Loader::init(__DIR__ . '/..');

$frequency = [];

// defind the clourse function
$freq = function ($line) {
    $ip = $this->getIp($line);
    global $frequency;

    if ($ip) {
        // echo '.';
        // $this->frequency[$ip] = (isset($this->frequency[$ip]) ? $this->frequency[$ip] + 1 : 1);
        $frequency[$ip]  = (isset($frequency[$ip]) ? $frequency[$ip] + 1 : 1);
    }
};

// loop through log files in a directory
// func glob() 可以获取正则匹配的所有文件
foreach (glob(LOG_FILES) as $fileName) {
    echo  $fileName . "<br>";
    /**@var $access SplFileObject*/
    $access = new Access($fileName);
    foreach ($access->fileIteratorByLine() as $line) {
        $freq->call($access, $line);
    }
}


//arsort($access->frequency);
//foreach ($access->frequency as $key => $value) {
//    printf('%16s : %6d' . "<br>", $key, $value);
//}

arsort($frequency);
foreach ($frequency as $key => $value) {
    printf('%16s : %6d' . "<br>", $key, $value);
}