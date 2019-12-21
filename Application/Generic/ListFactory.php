<?php
/**
 * User: Andy
 * Date: 2019/12/21
 * Time: 12:42
 */

namespace Application\Generic;

use Application\Database\Connection;
use PDO;
use Exception;


class ListFactory
{
	const ERROR_AWARE = "Class must be connection aware";

	public static function factory(ConnectionAwareInterface $class, $dbParams)
	{
		if ($class instanceof ConnectionAwareInterface) {
			$class->setConnection(new Connection($dbParams));
			return $class;
		} else {
			throw new Exception(self::ERROR_AWARE);
		}
		return false;
	}


}