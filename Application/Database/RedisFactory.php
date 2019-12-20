<?php
/**
 * User: Andy
 * Date: 2019/12/7
 * Time: 1:50
 */

namespace Application\Database;


class RedisFactory
{
    private $host;
    private $port;

    public function __construct(array $config)
    {
        $this->host = $config['host'] ?? '127.0.0.1';
        $this->port = $config['port'] ?? 6379;

        $this->redis = new \Redis();
    }

    public function getConnect()
    {
        $this->redis->connect($this->host, $this->port);
        return $this;
    }
}