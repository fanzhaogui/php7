<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/25
 * Time: 19:23
 */
require __DIR__ . '/../Application/Autoload/Loader.php';

\Application\Autoload\Loader::init(__DIR__ . '/..');

define('DEFAULT_URL', 'https://www.baidu.com');
define('DEFAULT_TAG', 'a');

// 获取用于执行扫描操作的表
$vac = new \Application\Web\Hoover();

// 使用了 PHP 7 中的null合并运算符 (??)
$url = strip_tags($_GET['url'] ?? DEFAULT_URL);
$tag = strip_tags($_GET['tag'] ?? DEFAULT_TAG);


//var_dump($vac->getContent($url));die;
// var_dump($vac->getTags($url, $tag));


var_dump($vac->getAttribute($url, 'href'));
