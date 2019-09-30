<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/30
 * Time: 17:24
 */

namespace Application\Form\Element;


use Application\Form\Generic;

/**
 * Form Element Selector
 *
 * Class Select
 * @package Application\Form\Element
 */
class Select extends Generic
{
    const DEFAULT_OPETION_KEY = 0;
    const DEFAULT_OPTION_VALUE = 'Choose';

    protected $options;
    protected $selectedKey = self::DEFAULT_OPETION_KEY;

    public function setOptions(array $options, $selectKey = self::DEFAULT_OPETION_KEY)
    {
        $this->options = $options;
        $this->selectedKey = $selectKey;

        if (isset($this->attributes['multiple'])) {
            $this->name .= '[]';
        }
    }

    // select 标签
    protected function getSelect()
    {
        $this->pattern = '<select name="%s" %s>' . PHP_EOL;
        return sprintf($this->pattern, $this->name, $this->getAttribs());
    }

    protected function getOptions()
    {
        $output = ' ';
        foreach ($this->options as $key => $value) {
            if (is_array($this->selectedKey)) {
                $selected = (in_array($key, $this->selectedKey)) ? ' selected' : ' ';
            } else {
                $selected = ($key == $this->selectedKey) ? ' selected' : ' ';
            }

            $output .= '<option value="' . $key . '"'
                . $selected . '>'
                . $value
                . '</option>';
        }

        return $output;
    }

    // 重写 func getInputOnly
    public function getInputOnly ()
    {
        $output = $this->getSelect();
        $output .= $this->getOptions();
        $output .= '</' . $this->getType() . '>';
        return $output;
    }
}