<?php
/**
 * User: Andy
 * Date: 2019/12/21
 * Time: 11:31
 */

namespace Application\Entity;


class Name
{
	protected $name;

	public function getName() :string
	{
		return $this->name;
	}


	public function setName()
	{
		return $this->name;
	}
}