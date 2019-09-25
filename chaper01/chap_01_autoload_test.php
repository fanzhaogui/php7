<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/25
 * Time: 18:26
 */

require __DIR__ . '/../Application/Autoload/Loader.php';

Application\Autoload\Loader::init(__DIR__ . '/..');

// 存在
$test = new Application\Test\TestClass();
echo $test->getTest();

// 不存在
$fake = new Application\Test\FakeClass();
echo $fake->getTest();



