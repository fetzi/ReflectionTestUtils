<?php
namespace Demo;


class SampleClass {

	private $fooField;

	public function getFooField() {
		return $this->fooField;
	}

	private function fooFunction($param1, $param2) {
		return $param1 . "<br>" . $param2;
	}

	protected function fooBarFunction() {
		return "<h1>fooBar</h1>";
	}
} 