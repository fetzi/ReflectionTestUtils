<?php
namespace Jopic;

/**
 * Class ReflectionTestUtils
 * @package Jopic
 * @author Johannes Pichler
 */
class ReflectionTestUtils {

	/**
	 * method for injecting fields into class objects
	 *
	 * @param $target the target object into which the method injects
	 * @param $name the name of the field to inject
	 * @param $object the inject instance
	 * @throws ReflectionTestUtilsException if property name cannot be found within object
	 */
	public static function setField($target, $name, $object) {
		$property = self::getProperty($target, $name);
		if($property->isPrivate() || $property->isProtected()) {
			$property->setAccessible(true);
		}

		$property->setValue($target, $object);
	}

	/**
	 * method for reading class property values
	 *
	 * @param $target the target object
	 * @param $name the property name
	 * @return mixed the selected property value
	 * @throws ReflectionTestUtilsException if the property name cannot be found within the given object
	 */
	public static function getField($target, $name) {
		$property = self::getProperty($target, $name);
		if($property->isPrivate() || $property->isProtected()) {
			$property->setAccessible(true);
		}

		return $property->getValue($target);
	}

	/**
	 * method for calling non-public methods on an ojbect
	 *
	 * @param $target the target object
	 * @param $methodName the method name to exectute
	 * @param array $args parameter array
	 * @throws ReflectionTestUtilsException if the given method cannot be found in within the object
	 */
	public static function invokeMethod($target, $methodName, $args = array()) {
		$clazz = new \ReflectionClass($target);

		try {
			$method = $clazz->getMethod($methodName);

			if($method->isPrivate() || $method->isProtected()) {
				$method->setAccessible(true);
			}
			return $method->invokeArgs($target, $args);
		}
		catch(\ReflectionException $ex) {
			throw new ReflectionTestUtilsException("Unable to find method $methodName", 0, $ex);
		}

	}

	private static function getProperty($target, $name) {
		$reflectionClass = new \ReflectionClass($target);

		try {
			return $reflectionClass->getProperty($name);
		}
		catch(\ReflectionException $ex) {
			throw new ReflectionTestUtilsException("unable to set field $name in target object", 0, $ex);
		}
	}
} 
