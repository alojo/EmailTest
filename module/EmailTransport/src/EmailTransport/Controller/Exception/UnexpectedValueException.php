<?php
namespace EmailTransport\Controller\Exception;

use EmailTransport\Controller\Error;

class UnexpectedValueException extends \UnexpectedValueException implements ExceptionInterface
{
	public function __construct($code)
	{
		parent::__construct(Error::getDescription($code), $code);
	}

	public function logException()
	{
		/**
		 * @todo write exception logger
		 */
	}
}