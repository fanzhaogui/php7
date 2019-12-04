<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/12/2
 * Time: 17:29
 */

require __DIR__ . '/../Application/Autoload/Loader.php';

use Application\Autoload\Loader;
use Application\Iterator\LargeFile;
use Application\Database\Connection;

Loader::init(__DIR__ . '/../');

const DB_CONFIG_FILE = '/../config/db.php';
const CSV_FILE = '/../data/files/prospects.csv';

try {
    // 读取文件内容
    // 连接数据库
    // 将数据存入

    $config = include __DIR__ . DB_CONFIG_FILE;
    $connect = new Connection($config);
    // 使用PDO的 prepare / execute
    $sql = "INSERT INTO `student`(`name`, `age`, `sex`) VALUES (?, ?, ?)";
    $statement = $connect->pdo->prepare($sql);

    $iterator = new LargeFile(__DIR__ . CSV_FILE);
    $count = 0;

    // 这里的line需要注意，正式要用时，需要确认一下这个类型
    // 我这里是获取到的 [0 => '名  11  0']
    foreach ($iterator->getIterator('Csv') as $row) {
        if (!empty($row) && count($row) == 3) {
            array_walk($row, function (&$item) {
                // 将内容字符转为utf-8格式
                // $item = mb_convert_encoding($item, "UTF-8", "GBK");
                $item =  iconv("GB2312//IGNORE", "UTF-8", $item);
            });
            $statement->execute($row);
            $count ++;
        }
    }
    echo "执行完毕，共插入{$count}数据<br>";
} catch (\Exception $e) {
    echo '执行导入时错误 ： ' . $e->getMessage();
}