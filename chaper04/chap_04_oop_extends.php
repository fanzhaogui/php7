<?php
/**
 * User: Andy
 * Date: 2019/12/21
 * Time: 10:18
 */

abstract class Base
{
	protected $id;

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	abstract public function validate();
}


class Customer extends Base
{
	protected $name;

	public function getName()
	{
		return $this->name;
	}

	public function setName($name)
	{
		$this->name = $name;
	}

	//
	public function validate()
	{
		// TODO: Implement validate() method.

		$volid = 0;
		$count = count(get_object_vars($this));
		if (!empty($this->id) && is_int($this->id)) {
			$volid ++;
		}
		if (!empty($this->name)) $volid ++;

		return ($volid == $count);
	}
}


class Member extends Customer
{
	protected $membership;

	public function getMembership()
	{
		return $this->membership;
	}

	public function setMembership($memberId)
	{
		$this->membership = $memberId;
	}

}


$customer = new Customer();
$customer->setId(100);
$customer->setName("Fred");

var_dump($customer);

echo ($customer->validate()) ? 'VALID' : 'NOT VALID';