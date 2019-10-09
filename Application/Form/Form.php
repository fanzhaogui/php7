<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/30
 * Time: 18:32
 */

namespace Application\Form;


use Application\Form\Element\Factory;

class Form extends Generic
{
    public function getInputOnly ()
    {
        $this->pattern = '<form name="%s" %s' . PHP_EOL;
        return sprintf($this->pattern, $this->name, $this->getAttribs());
    }



    /**
     * 闭合标签
     *
     * @return string
     */
    public function closeTag()
    {
        return '</' . $this->type . '>';
    }



}