<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/12/5
 * Time: 9:22
 */

declare(strict_types = 1); // 此声明是函数的参数可以是用标量限定， only used > php7

/**
 * htmlList
 * @author: fanzhaogui
 * @param $iterator ArrayIterator
 */
function htmlList($iterator)
{
    $output = '<ul>';

    /* 方式一
     while ($value = $iterator->current()) {
        $output .= '<li>' . $value . '</li>';
        $iterator->next();
    }*/

    foreach ($iterator as $value) {
        $output .= '<li>' . $value . '</li>';
    }/**/

    $output .= '</ul>';

    return $output;
}


/**
 * @author: fanzhaogui
 * @param $sql
 * @param $connection \Application\Database\Connection
 * @return ArrayIterator
 */
function fetchCountryName($sql, $connection) {
    $iterator = new ArrayIterator();
    $stmt = $connection->pdo->query($sql);
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $iterator->append($row['name']);
    }
    return $iterator;
}

// $pagination = new LimitIterator(fetchCountryName($sql, $connection), $offset, $limit);



// 起过滤作用的方法
// 该方法将部分国家名称和ArraryIterator实例作为其参数来接收
/**@var $innerIterator ArrayIterator */
function nameFilterIterator ($innerIterator, $name)
{
    if (!$name) return $innerIterator;
    $name = trim($name);
    $iterator = new CallbackFilterIterator($innerIterator, function ($current, $key, $iterator) use ($name) {
        // 匹配值中包含$name字符串的值
        $pattern = '/'. $name .'/i';
        return (bool) preg_match($pattern, $current);
    });
    return $iterator;
}

// 返回数据$array中符合条件的组，数组不为空时
function filteredResultGenerator(array $array, $filter, $limit = 10, $page = 0)
{
    $max = count($array);
    $offset = $page * $limit;
    foreach ($array as $key => $value) {
        if (!stripos($value, $filter) != false) continue;
        if (--$offset >= 0) continue; // 当还存在偏移量是，即有数据时，继续
        if (--$limit <= 0) break; // 当
        yield $value;
    }
}


function someName() {}

function someOtherName() {}

function someInfinite() {}

function someDirScan() {}

// 执行数据类型
function someTypeHint(Array $a, DateTime $t, Callback $c) {
    $message = '';
    $message .= 'Array count :' . count($a) .PHP_EOL;
    $message .= 'Date : ' . $t->format('Y-m-d') . PHP_EOL;
    $message .= 'Callable Return : ' . $c() . PHP_EOL;
    return $message;
}


function someScalarHint (bool $b, int $i, float $f, string $s) {
    return '';
}
// 如果传入的值类型不一致，则抛出 TypeError


function someBoolHint (bool $b) {
    return $b;
}

/*try {
    someBoolHint(123);
} catch (TypeError $e) {
    // TypeError instanceof Throwable
    echo $e->getMessage();
}*/


/*匿名类*/
$a = [];
$i = new ArrayIterator($a);
$f = new class($i) extends FilterIterator {
	public function accept()
	{
		$current = $this->current();
		return !(ord($current) & 1);
	}
};
// 该实例中，匿名类扩展了FilterIterator类并重写了accept()方法，使该方法仅接收ASCII码为偶数的字母：



function pagination($iterator, $offset, $limit)
{

}