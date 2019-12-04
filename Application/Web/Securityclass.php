<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/26
 * Time: 14:16
 */

namespace Application\Web;

/**
 * 数据过滤和验证
 * Class Securityclass
 * @package Application\Web
 */
class Securityclass
{
    // 过滤函数
    public $filter = NULL;

    // 验证函数
    public $validate = NULL;


    public function __construct ()
    {
        $this->filter = [
            'striptags' => function ($a) {
                return strip_tags($a);
            },
            'digits'    => function ($a) {
                return preg_replace('/[^0-9]/', '', $a);
            },
            'alpha'     => function ($a) {
                return preg_replace('/[^A-Z]/i', '', $a);
            },
        ];

        $this->validate = [
            'alnum'  => function ($a) {
                return ctype_alnum($a);
            },
            'digits' => function ($a) {
                return ctype_digit($a);
            },
            'alpha'  => function ($a) {
                return ctype_alpha($a);
            },
        ];
    }

    // $security->filterDigits($item);  filter + digits
    public function __call ($method, $arguments)
    {
        preg_match('/^(filter|validate)(.*?)$/i', $method, $matches);
        $prefix = $matches[1] ?? '';
        $function = strtolower($matches[2] ?? '');

        // var_dump($matches, $prefix, $function);
        // 都存在的情况下
        if ($prefix && $function) {
            return $this->$prefix[$function]($arguments[0]);
        }
        return $arguments[0];
    }
}