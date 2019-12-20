<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/12/5
 * Time: 9:32
 */

require  __DIR__ . '/../Application/Autoload/Loader.php';

require_once __DIR__ . DIRECTORY_SEPARATOR . 'chap_03_developing_functions_iterator_library.php';

use Application\Autoload\Loader;
Loader::init(__DIR__ . '/../');
use Application\Web\Hoover;


$url = trim(strip_tags($_GET['url'] ?? ''));
$filter = trim(strip_tags($_GET['filter'] ?? ''));
$limit = (int) ($_GET['limit'] ?? '10');
$page = (int) ($_GET['page'] ?? '0');

// 空运算符 ?? 最适合通过网页获取输入数据。在没有定义的情况下，该运算符不会生成任何警告。
// 如果参数没有收到用户输入的数据，你可以为其设置一个默认值

$next = $page + 1;
$prev = $page - 1;
$base = '?url=' . htmlspecialchars($url)
	. '&filter' . htmlspecialchars($filter)
	. '&limit' . $limit
	. '&page=';


$vac = new Hoover();
$list = $vac->getAttribute($url, 'href');

?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport"
		  content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
</head>
<body>
<form action="">
	<table>
		<tr>
			<th>URL</th>
			<td><input type="text" name="url" value="<?=htmlspecialchars($url) ?>" /></td>
		</tr>

		<tr>
			<th>Filter</th>
			<td><input type="text" name="filter" value="<?=htmlspecialchars($filter) ?>"></td>
		</tr>
		<tr>
			<th>Limit</th>
			<td><input type="text" name="limit" value="<?=htmlspecialchars($limit)?>"></td>
		</tr>
		<tr>
			<th>&nbsp;</th>
			<td><input type="submit" /></td>
			<td>&nbsp;</td>
			<td>
				<a href="<?= $base . $prev ?>"><-- PREV </a>|
				<a href="<?= $base . $next ?>">NEXT--></a>
			</td>
		</tr>
	</table>
</form>
<hr>
<?= htmlList(filteredResultGenerator($list, $filter, $limit, $page));?>
</body>
</html>
