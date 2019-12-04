<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/29
 * Time: 15:44
 */

// PHP 5 和 PHP7 中foeach()的差异

$a = [1, 2, 3];

$b = &$a;

foreach ($a as $v) {
    echo $v;
    unset($a[1]);
}

