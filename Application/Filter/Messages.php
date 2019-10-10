<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/10/9
 * Time: 17:16
 */

namespace Application\Filter;


/**
 * 为保证 每个回调函数都应该引用同一组消息。
 *
 * Class Messages
 * @package Application\Filter
 */
class Messages
{
    const MESSAGE_UNKNOWN = 'Unknown';

    /**
     * 用于设置所有消息或仅一条消息的类。
     * @var
     */
    public static $messages;

    public static function setMessages(array $messages)
    {
        self::$messages = $messages;
    }

    public static function setMessage($key, $message)
    {
        self::$messages[$key] = $message;
    }

    public static function getMessage($key)
    {
        return self::$messages[$key] ?? self::MESSAGE_UNKNOWN;
    }
}