<?php
namespace EmailTransport\Controller;

class Smtp
{
	const SMTP_HOST = '10.124.128.220';
	const SMTP_PORT = '25';
	const SMTP_USER = '';
	const SMTP_PASS = '';

	private $smtpTransport;
	private $requiredCredentials = array(
		'host',
		'port',
		'user',
		'pass'
	);

	public function __construct($info = array())
	{
		if (!empty($info)
			&& count(array_intersect_key(array_flip($this->requiredCredentials), $info) == count($this->requiredCredentials))
		) {
			$this->setTransport(
				\Swift_SmtpTransport::newInstance()
					->setHost($info['host'])
					->setPort($info['port'])
					->setUsername($info['user'])
					->setPassword($info['pass'])
			);
		} else {
			$this->setTransport(
				\Swift_SmtpTransport::newInstance()
					->setHost(self::SMTP_HOST)
					->setPort(self::SMTP_PORT)
					->setUsername(self::SMTP_USER)
					->setPassword(self::SMTP_PASS)
			);
		}
	}

	public static function newInstance($info = array())
	{
		return (new self($info))->getTransport();
	}

	public function getTransport()
	{
		return $this->smtpTransport;
	}

	public function setTransport($transport)
	{
		$this->smtpTransport = $transport;
	}
}
