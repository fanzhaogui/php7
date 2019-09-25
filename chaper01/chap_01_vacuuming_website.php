<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/25
 * Time: 19:23
 */
require __DIR__ . '/../Application/Autoload/Loader.php';

\Application\Autoload\Loader::init(__DIR__ . '/..');

define('DEFAULT_URL', 'https://baidu.com');
define('DEFAULT_TAG', 'a');

// 获取用于执行扫描操作的表
$vac = new \Application\Web\Hoover();
