<?php

require __DIR__ . '/../Application/Autoload/Loader.php';

use Application\Autoload\Loader;
use Application\Web\Deep;

define("DEFAULT_URL", 'http://www.sccnn.com');
define("DEFAULT_TAG", "img");



Loader::init(__DIR__ . '/..');
/**
 *  爬取某个网页里，指定的标签内容
 */
$deep = new Deep();

$url = strip_tags($_GET['url'] ?? DEFAULT_URL);
$tag = strip_tags($_GET['tag'] ?? DEFAULT_TAG);


foreach ($deep->scan($url, $tag) as $item) {
    $src = $item['attributes']['src'] ?? null;
    if ($src && (stripos($src, 'png') || stripos($src, 'jpg'))) {
        if (stripos($src, 'http') == 0) {
            printf('<br><img src="%s" />', $src);
        } else {
            printf('<br><img src="%s" />', DEFAULT_URL.$src);
        }
    }
}