<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/10/8
 * Time: 10:20
 */

namespace Application\Form;

/**
 * 工厂类
 *
 * Class Factory
 * @package Application\Form\Element
 */
class Factory
{
    /**
     * 存储生成器对象
     *
     * @var
     */
    protected $elements;

    public function getElements()
    {
        return $this->elements;
    }

    /**
     * 遍历配置数组，创建合适的对象
     *
     * @param array $config
     * @return object Factory
     */
    public static function generate(array $config)
    {
        $form = new self();

        foreach ($config as $key => $p) {
            $p['errors'] = $p['errors'] ?? array();
            $p['wrappers'] = $p['wrappers'] ?? array();
            $p['attributes'] = $p['attributes'] ?? array();

            $form->elements[$key] = new $p['class'](
                $key,
                $p['type'],
                $p['label'],
                $p['wrappers'],
                $p['attributes'],
                $p['errors']
            );

            // options 参数
            if (isset($p['options'])) {

                list($a, $b, $c, $d) = $p['options'];

                switch ($p['type']) {
                    case Generic::TYPE_RADIO:

                    case Generic::TYPE_CHECKBOX:
                        $form->elements[$key]->setOptions($a, $b, $c, $d);
                        break;
                    case Generic::TYPE_SELECT:
                        $form->elements[$key]->setOptions($a, $b);
                        break;
                    default:
                        $form->elements[$key]->setOptions($a, $b);
                        break;
                }
            }
        }

        return $form;
    }

    protected function getWrapperPattern($wrapper)
    {
        $type = $wrapper['type'];
        unset($wrapper['type']);
        $pattern = '<' . $type;
        foreach ($wrapper as $key => $value) {
            $pattern .= ' ' . $key . '="' . $value . '"';
        }
        $pattern .= '>%s</' . $type . '>';
        return $pattern;
    }


    public function render (Factory $form, $formConfig)
    {
        $rowPattern = $form->getWrapperPattern($formConfig['row_wrapper']);
        $contents = '';
        foreach ($form->getElements() as  $element) { // $element == Generic::render()
            $contents .= sprintf($rowPattern, $element->render());
        }

        $formTag = new Form($formConfig['name'], Generic::TYPE_FORM, ' ', array(), $formConfig['attributes']);
        $formPattern = $form->getWrapperPattern($formConfig['form_wrapper']);

        if (isset($formConfig['form_tag_inside_wrapper']) && !$formConfig['form_tag_inside_wrapper']) {
            $formPattern = '%s' . $formPattern  . '%s';
            return sprintf($formPattern, $formTag->getInputOnly(), $contents, $formTag->closeTag());
        }
        else {
            return sprintf($formPattern, $formTag->getInputOnly() . $contents . $formTag->closeTag());
        }
    }
}