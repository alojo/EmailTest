<?php
namespace EmailTransport\Helper;

class Header
{
	public static function arrange(&$array, $source = null)
	{
		$tmp = array();
		if ('file' == $source) {
			foreach ($array as $index => $data) {
				$tmp[$data['email']] = $data['name'];
			}
		} else {
			foreach ($array as $k => $v) {
				if (Validator\EmailAddress::isValid($v)) {
					$tmp[$v] = $k;
				} else if (!Validator\EmailAddress::isValid($k)) {
					throw new Exception\UnexpectedValueException(Error::getDescription(Error::EMAIL_ADDRESS_INVALID));
				}
			}
			if (!empty($tmp)) {
				$array = array_merge($array, $tmp);
				foreach ($tmp as $k => $v) {
					unset($array[$v]);
				}
			}
		}
		return $array;
	}
}