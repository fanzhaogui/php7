<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/12/2
 * Time: 17:11
 */

namespace Application\Database;

use \Exception;

use PDO;

/**
 * PDO 构建器
 * @package Application\Database
 */
class Connection
{
    const ERROR_UNABLE = 'ERROR: Unable to create database connection';

    public $pdo;

    public function __construct(array $config)
    {
        if (!isset($config['driver'])) {
            $message = __METHOD__ . ' : ' . self::ERROR_UNABLE . PHP_EOL;
            throw new Exception($message);
        }

        $dsn = $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['dbname'];

        try {
            $this->pdo = new PDO($dsn, $config['user'], $config['password'], [PDO::ATTR_ERRMODE => $config['errmode']]);
        } catch (\PDOException $e) {
			var_dump($e->getMessage());
        }
    }


    public static function factory($drive, $dbname, $host, $user, $pwd, array $option = [])
	{
		$dsn = sprintf("%s:dbname=%s;host=%s", $drive, $dbname, $host);
		try {
			return new PDO($dsn, $user, $pwd, $option);
		} catch (\PDOException $e) {
			var_dump($e->getMessage());
		}
	}
}