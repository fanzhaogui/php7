<?php

require __DIR__ . '/../Application/Autoload/Loader.php';

\Application\Autoload\Loader::init(__DIR__ . '/..');

include __DIR__ . '/chap_06_post_data_config_messages.php';
include __DIR__ . '/chap_06_post_data_config_callbacks.php';


// 定义能够将需要执行过滤操作的数据段和执行过滤操作的回调函数关联起来的$assignment数组。使用 * 键定义于所有数据的全局数组
$assigments = [
    '*' => [
        ['key' => 'trim', 'params' => []],
        ['key' => 'strip_tags', 'params' => []],
    ],
    'first_name' => [
        ['key' => 'length', 'params' => ['length' => 128]],
    ],
    'city' => [
        ['key' => 'length', 'params' => ['length' => 64]],
    ],
    'budget' => [
        ['key' => 'filter_float', 'params' => []],
    ],
];

// 定义合法和非法的测试数据