<?php
/**
 * User: Andy
 * Date: 2019/12/21
 * Time: 1:57
 */

declare(strict_types = 1);

namespace Application\Test;

/**
 * 这是一个示例类
 *
 * 这个类的作用是获取和设置
 * 受保护的属性 即私有属性 $test
 *
 * @package Application\Test
 */
class Test
{
	protected $test = 'TEST';

	public static $sTest = 'Static Test';

	public static function getStaticTest()
	{
		return self::$sTest;
	}


	/**
	 * 该方法会返回变量$test的当前变量
	 *
	 * @返回变量$test中的值，如果该值不是符合类型的，会将其转换为字符型
	 *
	 * @return string
	 */
	public function getTest() :string
	{
		return $this->test;
	}


	public function setTest(string $test)
	{
		$this->test = $test;
		return $this;
	}


}