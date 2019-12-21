<?php
/**
 * User: Andy
 * Date: 2019/12/21
 * Time: 12:45
 */

namespace Application\Generic;


use Application\Database\Connection;

class CountryList implements ConnectionAwareInterface
{
	protected $connect;

	public function setConnection(Connection $connection)
	{
		$this->connect = $connection;
	}

	public function list()
	{
		$list = [];
		$stmt = $this->connect->pdo->query('select id,name from iso_country_codes');

		while ($country = $stmt->fetch(\PDO::FETCH_ASSOC)) {
			$list[$country['id']] = $country['name'];
		}
		return $list;
	}
}