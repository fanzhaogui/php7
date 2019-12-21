<?php
/**
 * User: Andy
 * Date: 2019/12/21
 * Time: 17:10
 */

const DB_CONFIG_FILE = '/../config/db.php';

require_once __DIR__ . "/../Application/Autoload/Loader.php";
use Application\Autoload\Loader;

Loader::init(__DIR__ . '/../');

$params = include __DIR__ . DB_CONFIG_FILE;

use Application\Generic\ListFactory;
use Application\Generic\CountryList;

$list = ListFactory::factory(new CountryList(), $params);

/**@var $list CountryList*/
foreach ($list->list() as  $item) {
	echo $item . '<br/>';
}