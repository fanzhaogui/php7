<?php

require __DIR__ . '/../Application/Autoload/Loader.php';

define("DEFAULT_URL", 'http://www.sccnn.com');
define("DEFAULT_TAG", "img");


\Application\Autoload\Loader::init(__DIR__ . '/..');

$deep = new \Application\Web\Deep();

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