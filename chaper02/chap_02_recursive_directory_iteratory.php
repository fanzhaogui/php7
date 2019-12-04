<?php
/**
 * User: Andy
 * Date: 2019/12/4
 * Time: 23:04
 */

require __DIR__ . '/../Application/Autoload/Loader.php';

use Application\Autoload\Loader;
use Application\Iterator\Directory;

Loader::init(__DIR__ . '/../');

define('EXAMPLE_PATH', realpath(__DIR__ . '/../'));

$directory = new Directory(EXAMPLE_PATH);


try {
    echo 'Mimics "ls -l -R" ' . PHP_EOL;

    // Call to undefined function 0666()
    foreach ($directory->ls('*.php') as $info) {
        echo $info;
    }

    echo str_repeat('--', 40);
    echo 'Mimics "dir /s" ' . PHP_EOL;

    foreach ($directory->dir('*.php') as $info) {
        echo $info;
    }


} catch (\Throwable $e) {
    //echo $e->getMessage();
    echo $e->getTraceAsString();
}