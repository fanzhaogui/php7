<?php
/**
 * User: Andy
 * Date: 2019/12/21
 * Time: 12:44
 */

namespace Application\Generic;


use Application\Database\Connection;

interface ConnectionAwareInterface
{
	public function setConnection(Connection $connection);
}