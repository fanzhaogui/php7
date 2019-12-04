<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/26
 * Time: 14:50
 */

require __DIR__  . '/../Application/Autoload/Loader.php';

use Application\Autoload\Loader;
use Application\Web\Securityclass;

Loader::init(__DIR__ . '/..');

$security = new Securityclass();

$data = [
    '<ul><li>Lots</li><li>Of</li><li>Tags</li></ul>',
    123456,
    'This is a string',
    'String with number 123456'
];


// 使用过滤器和验证器处理测试数据的每一项
foreach ($data as $item) {
    echo 'ORIGINAL: ' . htmlentities($item) . '<br>';
    echo 'FILTERING' . '<br>';
    printf('%12s : %s'. '<br>' , 'Strip Tags', htmlentities($security->filterStripTags($item)));
    printf('%12s : %s'. '<br>' , 'Digits', $security->filterDigits($item));
    printf('%12s : %s'. '<br>' , 'Alpha', $security->filterAlpha($item));

    echo 'VALIDATORS' . '<br>';
    printf('%12s : %s'. '<br>' , 'Alnum', ($security->validateAlnum($item) ? 'T' : 'F'));
    printf('%12s : %s'. '<br>' , 'Digits', ($security->validateDigits($item) ? 'T' : 'F'));
    printf('%12s : %s'. '<br>' , 'Alpha', ($security->validateAlpha($item) ? 'T' : 'F'));
}