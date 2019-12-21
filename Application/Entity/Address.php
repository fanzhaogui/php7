<?php
/**
 * User: Andy
 * Date: 2019/12/21
 * Time: 11:32
 */

namespace Application\Entity;


class Address
{
	protected $address;

	public function getAddress()
	{
		return $this->address;
	}

	public function setAddress($address)
	{
		$this->address = $address;
	}
}