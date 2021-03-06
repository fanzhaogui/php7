<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/25
 * Time: 19:15
 */

namespace Application\Web;


class Hoover
{
    public $content;

    // 获取URL内容
    public function getContent($url)
    {
        if (!$this->content) {
            if (stripos($url, 'http') !== 0) {
                $url = 'http://' . $url;
            }

            // php.net/manual/en/class.domdocument.php
            $this->content = new \DOMDocument('1.0', 'utf-8');
            $this->content->preserveWhiteSpace = false;
            // @符号用于过滤掉配置错误的网页所生成的警告
            @$this->content->loadHTMLFile($url);
        }
        return $this->content;
    }

    // 获取标签
    public function getTags($url, $tag)
    {
        $count = 0;
        $result = array();
        $elements = $this->getContent($url)
            ->getElementsByTagName($tag);

        foreach ($elements as $node) {
            $result[$count]['value'] = trim(preg_replace('/\s+/',  ' ', $node->nodeValue));
            /**@var $node \DOMNode*/
            if ($node->hasAttributes()) {
                foreach ($node->attributes as $name => $attr) {
                    $result[$count]['attributes'][$name] = $attr->value;
                }
            }
            $count ++;
        }
        return $result;
    }

    // 提取属性
    public function getAttribute($url, $attr, $domain = null)
    {
        $result = array();
        $elements = $this->getContent($url)
            ->getElementsByTagName('*');
        foreach ($elements as $node) {
            /**@var $node \DOMElement*/
            if ($node->hasAttribute($attr)) {
                $value = $node->getAttribute($attr);
                if ($domain) {
                    if (stripos($value, $domain) !== false) {
                        $result[] = trim($value);
                    }
                } else {
                    $result[] = trim($value);
                }
            }
        }

        return $result;
    }
}