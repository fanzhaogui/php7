<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/10/8
 * Time: 10:20
 */

namespace Application\Form\Element;

use Application\Form\Generic;

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

    public static function generate(array $config)
    {
        $form = new self();

        $a = $b = $c = $d = NULL;

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
                switch ($p['type']) {
                    case Generic::TYPE_RADIO:
                        break;

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
}