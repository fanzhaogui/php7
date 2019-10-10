<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/10/9
 * Time: 17:22
 */

namespace Application\Filter;

use UnexpectedValueException;

/**
 * 是用该类增强程序的核心功能
 *
 * Class AbstractFilter
 * @package Application\Filter
 */
abstract class AbstractFilter
{
    const BAD_CALLBACK = 'Must implement CallbackInterface';
    const DEFAULT_SEPARATOR = '<br>' . PHP_EOL;
    const MISSING_MESSAGE_KEY = 'item missing';
    const DEFAULT_MESSAGE_FORMAT = '%20s : %60s';
    const DEFAULT_MISSING_MESSAGE = 'ITEM Missing';

    protected $separator; // 用于显示消息
    protected $callbacks;
    protected $assignments;
    protected $missingMessage;
    protected $results; // Application\Filter\Reuslt 对象


    public function __construct (array $callbacks, array $assignments, $separator = null, $message = null)
    {
        $this->setCallbacks($callbacks);
        $this->setAssignments($assignments);
        $this->setSeparator($separator ?? self::DEFAULT_SEPARATOR);
        $this->setMissingMessage($message ?? self::DEFAULT_MISSING_MESSAGE);
    }

    public function getOneCallback($key)
    {
        return $this->callbacks[$key] ?? NULL;
    }

    public function getCallbacks()
    {
        return $this->callbacks;
    }

    public function setMissingMessage($message)
    {
        $this->missingMessage = $message;
    }

    public function setSeparator($separator)
    {
        $this->separator = $separator;
    }

    public function setAssignments(array $assignments)
    {
        $this->assignments = $assignments;
    }

    public function setCallbacks(array $callbacks)
    {
        foreach ($callbacks as $key => $item) {
            $this->setOneCallback($key, $item);
        }
    }

    public function setOneCallback($key, $item)
    {
        if ($item instanceof CallbackInterface) {
            $this->callbacks[$key] = $item;
        }
        else {
            throw new UnexpectedValueException(self::BAD_CALLBACK);
        }

    }

    public function removeOneCallBack($key)
    {
        if (isset($this->callbacks[$key])) {
            unset($this->callbacks[$key]);
        }
    }

    public function getResults()
    {
        return $this->results;
    }

    /**
     * 返回一组Result对象
     * @return array [object Result]
     */
    public function getItemsAsArray()
    {
        $return = [];
        if ($this->results) {
            foreach ($this->results as $key => $item) {
                $return[$key] = $item->item; // $item == Result
            }
        }
        return $return;
    }

    public function getMessages()
    {
        if ($this->results) {
            foreach ($this->results as $key => $item) {
                if ($item->messages) {
                    yield from $item->messages; // $item == Application\Filter\Result
                }
            }
        }
        else {
            return [];
        }
    }


    public function getMessageString($width = 80, $format = null)
    {
        if (!$format) {
            $format = self::DEFAULT_MESSAGE_FORMAT . $this->separator;
        }
        $output = ' ';
        if ($this->results) {
            foreach ($this->results as $key => $value) {
                if ($value->messages) {
                    foreach ($value->messages as $message) {
                        $output .= sprintf($format, $key, trim($message));
                    }
                }
            }
        }
        return $output;
    }
}