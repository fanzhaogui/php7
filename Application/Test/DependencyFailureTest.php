<?php
/**
 * Created by PhpStorm.
 * User: fanzhaogui
 * Date: 2019/9/29
 * Time: 11:31
 */

namespace Application\Test;


use PHPUnit\Framework\TestCase;

class DependencyFailureTest extends TestCase
{
    public function testOne()
    {
        $this->assertTrue(false);
    }

    /**
     * @depends testOne
     */
    public function testTwo()
    {

    }
}

// cmd: phpunit --verbose DependencyFailureTest
