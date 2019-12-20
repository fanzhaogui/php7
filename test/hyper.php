<?php
/**
 * User: Andy
 * Date: 2019/12/7
 * Time: 1:54
 */

require  __DIR__ . '/../Application/Autoload/Loader.php';

use Application\Autoload\Loader;

Loader::init(__DIR__ . '/../');

$config = require_once __DIR__ . '/../config/reids.php';

use Application\Database\RedisFactory;

$redisObj = new RedisFactory($config);
$redis = $redisObj->getConnect();

$ipList = [
    '10.1.1.1',
    '10.1.1.2',
    '10.1.1.3',
    '10.1.1.4',
    '10.1.1.5',
    '10.1.1.6',
    '10.1.1.7',
];

$key = 'ips' . date('Y_m_d');
foreach ($ipList as $ip) {
    $redis->redis->rawCommand('pfadd', $key, $ip);
}

$count = $redis->redis->rawCommand('pfcount', 'ips');

echo $count;