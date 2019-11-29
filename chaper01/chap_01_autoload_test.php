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
echo "correct : " . $test->getTest();
echo "<br/>";

// 不存在
try {
    $fake = new Application\Test\FakeClass();
    echo "not exists : " . $fake->getTest();

} catch (Exception $e) {

    echo "class is not exists ,the error : " . $e->getMessage();
}




