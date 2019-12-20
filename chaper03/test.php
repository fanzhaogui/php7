<?php
/**
 * User: Andy
 * Date: 2019/12/4
 * Time: 23:50
 */


// declare(strict_types = 1);
//declare(); //????? 参数可以声明为 标量 类型

//function t(bool $b, int $i, float $f, string $s) {
//
//}

$date = new DateTime();

print_r( $date->getTimezone());
