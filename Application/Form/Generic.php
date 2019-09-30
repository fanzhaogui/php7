<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/30
 * Time: 13:46
 */

namespace Application\Form;

/**
 * 表单构建器
 *
 * Class Generic
 * @package Application\Form
 */
class Generic
{
    const ROW = 'row';
    const FORM = 'form';
    const INPUT = 'input';
    const LABEL = 'label';
    const ERRORS = 'errors';
    const TYPE_FORM = 'form';
    const TYPE_TEXT = 'text';
    const TYPE_EMAIL = 'email';
    const TYPE_RADIO = 'radio';
    const TYPE_SUBMIT = 'submit';
    const TYPE_SELECT = 'select';
    const TYPE_PASSWORD = 'password';
    const TYPE_CHECKBOX = 'checkbox';
    const TYPE_TEXTAREA = 'textarea';
    const DEFAULT_TYPE = self::TYPE_TEXT;
    const DEFAULT_WRAPPER = 'div';

    protected $name;
    protected $type = self::DEFAULT_TYPE;
    protected $label = '';
    protected $errors = array();
    protected $wrappers;
    protected $attributes; // html表单属性
    protected $pattern = '<input type="%s" name="%s" %s>';


    /**
     * Creates generic element
     *
     * @param string $name = assigned to the <input name=$name ... >
     * @param mixed $type = (string) | Generic
     * @param string $label
     * @param array $wrappers = [INPUT => ['type' => 'div', + HTML attribs, i.e. 'class' => 'someClass', 'onClick' => etc.],
     * 							 LABEL => ['type' => 'div', + HTML attribs],
     * 							 ERRORS  => ['type' => 'div', + HTML attribs],
     * @param array $attributes = HTML attribs (i.e. ['maxLength' => 255, 'required' => NULL, etc.])
     * 							  setting an attrib to NULL means there will be no "=" on ouput
     * @param array $errors = ['Value missing', 'Maximum length exceeded', etc.]
     */
    public function __construct ($name, $type, $label = '',
                                 array $wrappers = array(),
                                 array $attributes = array(),
                                 array $errors = array())
    {
        $this->name = $name;
        if ($type instanceof Generic) {
            $this->type = $type->getType();
            $this->label = $type->getLabelValue();
            $this->errors = $type->getErrorsArray();
            $this->wrappers = $type->getWrappers();
            $this->type = $type->getAttributes();
        }
        else {
            $this->type = $type ?? self::DEFAULT_TYPE;
            $this->label = $label;
            $this->errors = $errors;
            $this->attributes = $attributes;
            if ($wrappers) {
                $this->wrappers = $wrappers;
            }
            else {
                $this->wrappers[self::INPUT]['type'] = self::DEFAULT_WRAPPER;
                $this->wrappers[self::LABEL]['type'] = self::DEFAULT_WRAPPER;
                $this->wrappers[self::ERRORS]['type'] = self::DEFAULT_WRAPPER;
            }
        }

        $this->attributes['id'] = $this->attributes['id'] ?? $name;
    }

    public function render()
    {
        return $this->getLabel() . $this->getInputWithWrapper() . $this->getErrors();
    }


    // 外部标签
    public function getWrapperPattern($type)
    {
        $pattern = '<' . $this->wrappers[$type]['type']; // <div
        foreach ($this->wrappers[$type] as $key => $value) {
            if ($key != $type) {
                $pattern .= ' ' . $key . '="' . $value . '"'; // type='text' name='username' placeholder='tip'
            }
        }
        $pattern .= '>%s</'. $this->wrappers[$type]['type'] . '>'; // >%s</div>;
        return $pattern;
    }

    // 结合外部标签，形成整个的标签块
    public function getLabel()
    {
        return sprintf($this->getWrapperPattern(self::LABEL), $this->label);
    }

    // 标签上的属性组装
    public function getAttribs()
    {
        $attribs = '';
        foreach ($this->attributes as $key => $value) {
            $key = strtolower($key);
            if ($value) {
                if ($key == 'value') {
                    if (is_array($value)) {
                        foreach ($value as $k => $v) {
                            $value[$k] = htmlspecialchars($v);
                        }
                    }
                    else {
                        $value = htmlspecialchars($value);
                    }
                }
                elseif ($key == 'href') {
                    $value = urlencode($value);
                }
                $attribs .= $key . '="' . $value . '" ';
            }
            else {
                $attribs .= $key . ' ';
            }
        }
        return trim($attribs);
    }

    // input 标签
    public function getInputOnly()
    {
        return sprintf($this->pattern, $this->type, $this->name, $this->getAttribs());
    }

    // 嵌入其他标签 input 框
    public function getInputWithWrapper()
    {
        return sprintf($this->getWrapperPattern(self::INPUT), $this->getInputOnly());
    }

    // errors
    /* @return  <ul><li>error 1</li><li>error 2</li><ul> */
    public function getErrors()
    {
        if (!$this->errors || count($this->errors) == 0) return '';
        $html = '';
        $pattern = '<li>%s</li>';
        foreach ($this->errors as $error) {
            $html .= sprintf($pattern, $error);
        }
        $html .= '<ul>';
        $html .= '</ul>';

        return sprintf($this->getWrapperPattern(self::ERRORS), $html);
    }

    // 单个属性
    public function setSingleAttribute($key, $value)
    {
        $this->attributes[$key] = $value;
    }

    // 增加一条错误提示
    public function addSingleError($error)
    {
        $this->errors[] = $error;
    }

    // select form 等标签
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }

    // 设置标签类型
    public function setType($type)
    {
        $this->type = $type;
    }

    public function setLabel ($label)
    {
        $this->label = $label;
    }


    public function getType()
    {
        return $this->type;
    }

    public function getLabelValue()
    {
        return $this->label;
    }

    public function getErrorsArray()
    {
        return $this->errors;
    }

    public function getWrappers()
    {
        return $this->wrappers;
    }

    public function getAttributes()
    {
        return $this->attributes;
    }

    public function setAttribute(array $attribute)
    {
        $this->attributes = $attribute;
    }
}