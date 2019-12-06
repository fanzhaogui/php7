<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/12/5
 * Time: 9:22
 */

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
    }

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

// 起过滤作用的方法
/**@var $innerIterator ArrayIterator */
function nameFilterIterator ($innerIterator, $name)
{

}


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