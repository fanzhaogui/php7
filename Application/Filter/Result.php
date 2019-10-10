<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/10/9
 * Time: 17:01
 */

namespace Application\Filter;


class Result
{
    /**
     * 保存经过过滤的值或执行验证操作得到的布尔型结果
     *
     * @var mixed
     */
    public $item;

    /**
     * 保存执行过滤和验证器操作过程中生成的消息。
     * @var array
     */
    public $messages = [];

    public function __construct ($item, $messages)
    {
        $this->item = $item;
        if (is_array($messages)) {
            $this->messages = $messages;
        }
        else {
            $this->messages = [$messages];
        }
    }

    /**
     * 对同一个值有多中验证或过滤方式的时候，合并提示信息
     *
     * @param Result $result
     */
    public function mergeResults(Result $result)
    {
        $this->item = $result->item;
        $this->mergeMessages($result);
    }

    /**
     * @param Result $result
     */
    public function mergeMessages(Result $result)
    {
        if (isset($result->messages) && is_array($result->messages)) {
            $this->messages = array_merge($this->messages, $result->messages);
        }
    }

    /**
     * 合并结果
     *
     * @commit 当初现一次为false的结果时，验证的最终结果则为false
     * @param Result $result
     */
    public function mergeValidationResults(Result $result)
    {
        if ($this->item == true) {
            $this->item = (bool)$result->item;
        }
        $this->mergeMessages($result);
    }


}