<?php
require_once "bootstrap.php";

class ReflectionTestUtilsTest extends PHPUnit_Framework_TestCase {

	private $sampleClass;

	protected function setUp() {
		$this->sampleClass = new \Demo\SampleClass();
	}

	public function testSetFieldWithValidPropertyNameSetsField() {
		$foo = "foobar";

		\Jopic\ReflectionTestUtils::setField($this->sampleClass, "fooField", $foo);

		$this->assertEquals($foo, $this->sampleClass->getFooField());
	}

	/**
	 * @expectedException Jopic\ReflectionTestUtilsException
	 */
	public function testSetFieldWithInvalidPropertyNameThrowsException() {
		\Jopic\ReflectionTestUtils::setField($this->sampleClass, "invalidFooField", null);
	}

	public function testGetfieldWithValidPropertyNameReturnsFieldValue() {
		$foo = "foobar";

		\Jopic\ReflectionTestUtils::setField($this->sampleClass, "fooField", $foo);

		$actual = \Jopic\ReflectionTestUtils::getField($this->sampleClass, "fooField");

		$this->assertEquals($foo, $actual);
	}

	/**
	 * @expectedException Jopic\ReflectionTestUtilsException
	 */
	public function testGetFieldWithInvalidPropertyNameThrowsException() {
		\Jopic\ReflectionTestUtils::getField($this->sampleClass, "invalidFooField");
	}

	public function testInvokeMethodWithValidMethodNameAndNoParamsExecutesMethod() {
		$expected = "<h1>fooBar</h1>";
		$actual = \Jopic\ReflectionTestUtils::invokeMethod($this->sampleClass, "fooBarFunction");

		$this->assertEquals($expected, $actual);
	}

	/**
	 * @expectedException Jopic\ReflectionTestUtilsException
	 */
	public function testInvokeMethodWithInvalidMethodNameThrowsException() {
		\Jopic\ReflectionTestUtils::invokeMethod($this->sampleClass, "invalidFunction");
	}

	public function testInvokeMethodWithValidMethodNameAndParamsExecutesMethod() {
		$expected = "a<br>b";
		$actual = \Jopic\ReflectionTestUtils::invokeMethod($this->sampleClass, "fooFunction", array("a", "b"));

		$this->assertEquals($expected, $actual);
	}
} 