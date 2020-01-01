<?php
/**
 * User: Andy
 * Date: 2019/12/22
 * Time: 12:10
 */

namespace Application\Alc;

use Application\Psr\RequesetInterface;
use Application\Psr\ResonseInterface;

interface AuthenticateInterface
{
	public function login(RequesetInterface $requeset) : ResonseInterface;
}