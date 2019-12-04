<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/29
 * Time: 15:44
 */

// PHP 5 和 PHP7 中foeach()的差异
echo "当前 PHP 版本" .PHP_VERSION . "<br>";
$a = [1, 2, 3];

$b = &$a;

foreach ($a as $v) {
    echo $v;
    unset($a[1]);
}
var_dump($a, $b);
// 这个结果并不是如书上所描述的那样， 难道翻译有错？
