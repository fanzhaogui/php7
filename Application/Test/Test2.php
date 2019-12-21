<?php
/**
 * User: Andy
 * Date: 2019/12/21
 * Time: 10:34
 */

namespace Application\Test;


/*测试延迟静态绑定*/
class Test2
{

	public static $test = 'Test';

	public static function getEarlyTest()
	{
		return self::$test;
	}

	public static function getLastTest()
	{
		return static::$test;
	}
}

class Child extends Test2
{
	public static $test = 'CHILD';
}


