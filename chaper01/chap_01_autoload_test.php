<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/25
 * Time: 18:26
 */

require __DIR__ . '/../Application/Autoload/Loader.php';

use Application\Autoload\Loader;
Loader::init(__DIR__ . '/../'); // 将根加入

// 存在
use Application\Test\TestClass;
$test = new TestClass();

echo "Correct : " . $test->getTest();
echo "<br/>";

// 不存在
try {
    $fake = new Application\Test\FakeClass();
    echo "not exists : " . $fake->getTest();

} catch (Exception $e) {

    echo "ERROR : class is not exists ,the error : " . $e->getMessage();
}




