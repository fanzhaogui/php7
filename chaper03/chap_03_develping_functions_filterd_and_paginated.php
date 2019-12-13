<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/12/13
 * Time: 16:29
 */


define('DB_CONFIG_FILE', __DIR__ . '/../config/db.php');
define('ITEM_PER_PAFE', [5, 10, 15, 20]);

require __DIR__ . '/../Application/Autoload/Loader.php';
require __DIR__ . '/chap_03_developing_functions_iterator_library.php';

use Application\Autoload\Loader;

Loader::init(__DIR__ . '/..');

use Application\Database\Connection;

$name   = strip_tags($_GET['name'] ?? '');
$limit  = (int)($_GET['limit'] ?? 10);
$page   = (int)($_GET['page'] ?? 0);
$offset = $page * $limit;
$pre    = ($page > 0) ? $page - 1 : 0;
$next   = $page + 1;

$dbconfig = include DB_CONFIG_FILE;
try {
    $connect = new Connection($dbconfig);
    $sql = "select * from iso_country_codes";
    $arrayIterator = fetchCountryName($sql, $connect);
    $filterIterator = nameFilterIterator($arrayIterator, $name);
    $limitIterator = new LimitIterator($filterIterator, $offset, $limit);

} catch (Throwable $e) {
    echo $e->getMessage();
    die;
}

?>

<html>
<head>

</head>
<body>
<h2>filtered and paginated results</h2>
<form action="">
    country name : <input type="text" name="name" value="<?=htmlspecialchars($name)?>"> <br><br>
    Items Per page :
    <select name="limit" id="">
        <?php foreach (ITEM_PER_PAFE as $item) :?>
            <option <?= ($item == $limit) ? 'selected': '';?>><?=$item?></option>
        <?php endforeach;?>
    </select>
    <br><br>
    <input type="submit" value="提交">
</form>
<a href="?name=<?=$name?>&limit=<?=$limit;?>&page=<?=$pre;?>">上一页</a>
<?=$page + 1;?>
<a href="?name=<?=$name?>&limit=<?=$limit;?>&page=<?=$next;?>">下一页</a>

<?=htmlList($limitIterator);?>
</body>
</html>
