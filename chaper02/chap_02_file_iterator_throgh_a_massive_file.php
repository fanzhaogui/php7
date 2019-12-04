<?php
/**
 * 读取大文件中的内容
 *
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/12/2
 * Time: 16:45
 */

// chap_02_file_iterator_throgh_a_massive_file.php

require __DIR__ . '/../Application/Autoload/Loader.php';

use Application\Autoload\Loader;
use Application\Iterator\LargeFile;

Loader::init(__DIR__ . '/../');

define("MASSIVE_FILE", '/../data/files/war_and_peace.txt');

try {
    $t1 = microtime(true);

    // SplFileObject 对象
    $largeFile = new LargeFile(__DIR__ . MASSIVE_FILE);
    // 读取方式
    $iterator = $largeFile->getIterator('ByLine');

    // 统计单词量
    $words = 0;
    foreach ($iterator as $line) {
        // echo $line;
        $words += str_word_count($line);
    }

    echo str_repeat('-', 52) . "<br>";

    echo 'Total words : ' . $words;

    $t2 = microtime(true);

    $t = $t2 - $t1;
    echo "花费时间：{$t}\n<br>";

} catch (\Exception $e) {

    echo 'Exception msg : ' . $e->getMessage();
}