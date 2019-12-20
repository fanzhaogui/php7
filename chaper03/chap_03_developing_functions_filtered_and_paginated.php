<?php
/**
 * User: Andy
 * Date: 2019/12/21
 * Time: 1:11
 */

require_once __DIR__ . '/../Application/Autoload/Loader.php';

use Application\Autoload\Loader;
use Application\Database\Connection;

// 将当前目录加入到register_autoload
Loader::init([__DIR__ . '/../']);

const DB_CONFIG_FILE = '/../config/db.config.php';
const ITEMS_PER_PAGE = [5, 10, 15, 20];

include __DIR__ . '/chap_03_developing_functions_iterator_library.php';

// 处理代表国家名称和每页记录条数的输入参数。将当前起始页设置为0，并且设置页码的增量
$name = strip_tags($_GET['name'] ?? '');
$limit = (int) ($_GET['limit'] ?? 10);
$page = (int) ($_GET['page'] ?? 0);
$offset = $page * $limit;
$prev = ($page > 0) ? $page - 1: 0;
$next = $page + 1;

try {

	$config = include __DIR__ . DB_CONFIG_FILE;
	$sql = "select * from iso_country_codes";
	$connection = new Connection($config);
	$arrayIterator = fetchCountryName($sql, $connection);
	$filterIterator = nameFilterIterator($arrayIterator, $name);
	$limitIterator = pagination($filterIterator, $offset, $limit);

} catch (Throwable $e) {
	echo $e->getMessage();
}