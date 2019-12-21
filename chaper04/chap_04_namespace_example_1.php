<?php
/**
 * User: Andy
 * Date: 2019/12/21
 * Time: 11:34
 */

require_once __DIR__ . '/../Application/Autoload/Loader.php';
use Application\Autoload\Loader;

Loader::init(__DIR__ . '/../');

use Application\Entity;

$name = new Entity\Name();
$addr = new Entity\Address();
$prof = new Entity\Profile();

var_dump($name);
var_dump($addr);
var_dump($prof);