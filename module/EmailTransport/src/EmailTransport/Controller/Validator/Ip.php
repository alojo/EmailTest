<?php

namespace EmailTransport\Controller\Validator;

class Ip {
	static private $blacklist = array(
		
	);
	
	public static function isValid($ip) {
		return !in_array($ip, static::$blacklist);
	}
}