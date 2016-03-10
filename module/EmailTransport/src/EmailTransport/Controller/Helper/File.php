<?php
namespace EmailTransport\Helper;

use EmailTransport\Error;
use EmailTransport\Exception;

class File
{

	public static function parse($file)
	{
		$extension = strtolower(static::getExtension($file));
		if('csv' == $extension) {
			$fileData = static::parseCsv($file);
		} else if (in_array($extension, array('xlsx','xlsm','xltx','xltm','xls','xlt'))) {
			$fileData = static::parseExcel($file);
		} else {
			throw new Exception\InvalidFileException(Error::ATTACHMENT_FILETYPE_INVALID);
		}
		return $fileData;
	}

	/**
	 * Retrieve file extension at path $file
	 * @param String $file
	 * @return String|NULL
	 */
	private static function getExtension($file)
	{
		return pathinfo($file, PATHINFO_EXTENSION);
	}

	/**
	 * Parse CSV file into array
	 * typical layout:
	 * array(
	 *     'name' => $name,
	 *     'email' => $email
	 *     [ ... DECORATORS ... ]
	 * )
	 * @param String $file
	 * @return Array $fileData
	 */
	private static function parseCsv($file)
	{
		$array = $map = array();
		$csvData = file_get_contents($fileName);
// 		$delimeters = \SplFileObject::getCsvControl($file);
// 		$lines = explode($delimeters[0], $csvData);
		$lines = explode("\n", $csvData);
		foreach ($lines as $line) {
			if (!empty($map)) $array[] = array_combine($map, str_getcsv($line));
			else $array[] = str_getcsv($line);

			if (1 == count($array)) $map = $array;
		}
		return $array;
	}

	/**
	 * Parse Excel file into array
	 * typical layout:
	 * array(
	 *     'name' => $name,
	 *     'email' => $email
	 *     [ ... DECORATORS ... ]
	 * )
	 * @param String $file
	 * @return Array $fileData
	 */
	private static function parseExcel($file)
	{
		$reader = PHPExcel_IOFactory::createReaderForFile($file);
		$reader->setReadDataOnly();
		$excel = $reader->load($file);
		foreach ($excelObj->getSheetNames($file) as $key => $sheet) {
			$excel->setActiveSheetIndexByName($sheet);
			$data[] = $excel->getActiveSheet()->toArray(null, true, true, true);
		}
		if (1 == count($data)) $data = $data[0];
		/** @todo create header map and subsequent rows using map */
	}
}