<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/25
 * Time: 19:53
 */

namespace Application\Web;

/**
 * 深层次网页扫描
 *
 * Class Deep
 * @package Application\Web
 */
class Deep
{
    protected $domain;

    public function scan($url, $tag)
    {
        $vac = new Hoover();
        $scan = $vac->getAttribute($url, 'href', $this->getDomain($url));
        // $result = array();
        foreach ($scan as $subSite) {
            // 通过yield from语法，我们可以将这个数组用作子生成器
            // $result[] = $vac->getTags($subSite, $tag);
            yield from $vac->getTags($subSite, $tag);
        }
        // return $result;
        return count($scan);
    }

    public function getDomain($url)
    {
        if (!$this->domain) {
            $this->domain = parse_url($url, PHP_URL_HOST);
        }
        return $this->domain;
    }
}