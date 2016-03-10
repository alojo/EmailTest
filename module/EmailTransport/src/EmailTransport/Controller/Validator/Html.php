<?php
namespace EmailTransport\Validator;

class Html
{
	private $xml;
	
	/**
	 * 
	 * @param String $string
	 */
	public function __construct($string)
	{
		$this->xml = new \SimpleXMLElement($string);
	}
	
	/**
	 * 
	 * @param string $string
	 * @return boolean
	 */
	public static function isValid($string = '')
	{
		if (!empty($string)) {
			$this->xml = new \SimpleXMLElement($string);
		}
		return ($this->xml->count() > 1);
	}
}