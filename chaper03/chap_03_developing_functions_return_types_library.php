<?php

// 任何接收到的参数都会放到$params参数里面
function someInfinite(...$params)
{
    return var_export($params, true);
}


// 递归函数
function dirScan($dir)
{
    // 使用关键字static将$list设置为静态变量，以便保留该变量的值
    static $list = [];

    // 获取当前路径的文件 和 目录列表
    $list = glob($dir . DIRECTORY_SEPARATOR . "*");
    // 通过循环方式执行操作
    foreach ($list as $item) {
        if (is_dir($item)) {
            // 递归查询子目录里面
            $list = array_merge($list, dirScan($item));
        }
    }
    return $list;
}