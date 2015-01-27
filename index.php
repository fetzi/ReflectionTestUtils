<?php
/* sample php file with method calls */
include "bootstrap.php";

$sampleClass = new Demo\SampleClass();

var_dump($sampleClass);

\Jopic\ReflectionTestUtils::setField($sampleClass, "fooField", new \Demo\SampleClass());

var_dump($sampleClass);

echo \Jopic\ReflectionTestUtils::invokeMethod($sampleClass, "fooFunction", array("a", "b"));

echo \Jopic\ReflectionTestUtils::invokeMethod($sampleClass, "fooBarFunction");