<?php
/**
 * User: Andy
 * Date: 2019/12/21
 * Time: 12:45
 */

namespace Application\Generic;


use Application\Database\Connection;

class CustomerList implements ConnectionAwareInterface
{
	protected $connect;

	public function setConnection(Connection $connection)
	{
		$this->connect = $connection;
	}

	public function list()
	{
		$list = [];
		$stmt = $this->connect->pdo->query('select id,name from customer');

		while ($customer = $stmt->fetch(\PDO::FETCH_ASSOC)) {
			$list[$customer['id']] = $customer['name'];
		}
		return $list;
	}
}