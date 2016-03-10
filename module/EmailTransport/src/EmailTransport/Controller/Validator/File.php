<?php
namespace EmailTransport\Controller\Validator;

use EmailTransport\Error;

class File
{
	/**
	 * Checks to see if $file is readable and has data
	 * @param String (path) $file
	 * @return boolean
	 */
	public static function isValid($file)
	{
		return (is_readable($file) && (filesize($file) > 0));
	}

	/**
	 * Get reason for invalid file
	 * @param String $file
	 * @return int $error
	 */
	public static function getReason($file)
	{
		$error = null;
		if (!file_exists($file))       $error = Error::ATTACHMENT_NOT_FOUND;
		else if (!is_readable($file))  $error = Error::ATTACHMENT_READ_FAIL;
		else if (filesize($file) == 0) $error = Error::ATTACHMENT_EMPTY;
		return $error;
	}
}
