<?php
/**
 * User: Andy
 * Date: 2019/12/21
 * Time: 11:33
 */

namespace Application\Entity;


class Profile
{
	protected $profile;


	public function getProfile()
	{
		return $this->profile;
	}


	public function setProfile($profile)
	{
		$this->profile = $profile;
	}
}