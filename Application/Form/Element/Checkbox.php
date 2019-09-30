<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/30
 * Time: 16:39
 */

namespace Application\Form\Element;


use Application\Form\Generic;

/**
 * 创建单选框
 *
 * Class Radio
 * @package Application\Form\Element
 */
class Checkbox extends Generic
{
    // 文字显示在点选框的后，还是前面
    const DEFAULT_AFTER = TRUE;
    // 每个radio的分隔
    const DEFAULT_SPACER = '&nbsp;';

    const DEFAULT_OPTION_KEY = [];

    const DEFAULT_OPTION_VALUE = 'Choose';

    protected $after = self::DEFAULT_AFTER;

    protected $spacer = self::DEFAULT_SPACER;

    protected $options = array();

    protected $selectedKey = self::DEFAULT_OPTION_KEY;


    // radio 的单独扩展方法
    public function setOptions(array $options, $selectedKey = self::DEFAULT_OPTION_KEY, $spacer = self::DEFAULT_SPACER, $after = TRUE)
    {
        $this->after = $after;
        $this->spacer = $spacer;
        $this->options = $options;
        $this->selectedKey = $selectedKey;
    }

    // 重构方法
    public function getInputOnly ()
    {
        $count = 1;
        $baseId = $this->attributes['id'];

        $output = '';
        foreach ($this->options as $key => $value) {
            $this->attributes['id'] = $baseId . $count++;
            $this->attributes['value'] = $key;

            if ($this->selectedKey && in_array($key, $this->selectedKey)) {
                $this->attributes['checked'] = '';
            }
            else {
                unset($this->attributes['checked']);
            }

            if ($this->after) {
                $html = parent::getInputOnly() . $value;
            }
            else {
                $html = $value . parent::getInputOnly();
            }
            $output .= $this->spacer . $html;
        }

        return $output;
    }
}