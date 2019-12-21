<?php
/**
 * User: Andy
 * Date: 2019/12/21
 * Time: 11:34
 */

require_once __DIR__ . '/../Application/Autoload/Loader.php';
use Application\Autoload\Loader;

Loader::init(__DIR__ . '/../');

use Application\Entity\{
	Name, Address, Profile
};

$name = new Name();
$addr = new Address();
$prof = new Profile();

var_dump($name);
var_dump($addr);
var_dump($prof);

echo "new function \n" ;
print_r(unpack('H*', random_bytes(10))[1]);