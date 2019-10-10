<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/10/9
 * Time: 17:11
 */

namespace Application\Filter;


/**
 * 回调函数返回兼容性的结果
 *
 * Class CallbackInterface
 * @package Application\Filter
 */
interface CallbackInterface
{
    /**
     * 把对象当做方法使用
     * @commit $obj = new CallbackSon(); $obj($item, $params); 可以唤起 __invoke()方法。
     * @commit PHP7 新特性，指定返回的数据类型
     * @param $item
     * @param $params
     * @return Result
     */
    public function __invoke ($item, $params) : Result;
}