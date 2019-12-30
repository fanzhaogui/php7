<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/12/27
 * Time: 10:11
 */

namespace Application\MiddleWare;

/**
 * 常量定义
 *
 * @package Application\MiddleWare
 */
class Constants
{
    const HEADER_HOST = 'Host';
    const HEADER_CONTENT_TYPE = 'Content-Type';
    const HEADER_CONTENT_LENGTH = 'Content-Length';

    const METHOD_GET = 'get';
    const METHOD_POST = 'post';
    const METHOD_PUT = 'put';
    const METHOD_DELETE = 'delete';

    const HTTP_METHODS = ['get', 'post', 'put', 'delete'];

    const STANDARD_PORTS = [
        'ftp' => 21, 'ssh' => 22, 'http' => 80, 'https' => 443,
    ];

    // form
    const CONTENT_TYPE_FORM_ENCODED = 'application/x-www-form-urlencoded';
    const CONTENT_TYPE_MULTI_FORM = 'multipart/form-data';
    const CONTENT_TYPE_HAL_JSON = 'application/hal+json';

    // http response code
    const DEFAULT_STATUS_CODE = 200;
    const DEFAULT_BODY_STREAM = 'php://input';
    const DEFAULT_REQUEST_TARGET = '/';

    const MODE_READ = 'r';
    const MODE_WRITE = 'w';

    // error
    const ERROR_BAD = 'ERROR: ';
    const ERROR_UNKNOW = 'ERROR: unknow';
    const ERROR_INVALID_URI = 'ERROR: invalid uri';
    //
    const STATUS_CODES = [
        200 => 'OK',
        301 => 'Moved Permanently',
        302 => 'Found',
        401 => 'Not Found',
        405 => 'Method Not Allowed',
        418 => 'I_m A teapot',
        500 => 'Internal Server Error',

    ];
}