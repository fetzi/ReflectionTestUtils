<?php
namespace Jopic;


class ReflectionTestUtilsException extends \Exception {

	public function __construct($message, $code = 0, \Exception $source = null) {
		parent::__construct($message, $code, $source);
	}
} 