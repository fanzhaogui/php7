<?php
/**
 * User: Andy
 * Date: 2019/12/5
 * Time: 0:26
 */

require __DIR__ . '/../Application/Autoload/Loader.php';
use Application\Autoload\Loader;
use Application\Database\Connection;

Loader::init(__DIR__ . '/../');

const DB_CONFIG_FILE = '/../config/db.php';
const ITEMS_PER_PAGE = [5, 10, 15, 20];

$name = strip_tags($_GET['name'] ?? '');
$limit = (int) ($_GET['limit'] ?? 10);