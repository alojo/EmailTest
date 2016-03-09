<?php
namespace EmailTransport\Controller;

class Message
{
	private $swiftMessage = null;

	private $to;
	private $cc;
	private $bcc;
	private $from;
	private $subject;
	private $html;
	private $text;
	private $attachments = array();
	private $returnPath = 'cdsglobal@magma.ca';

	public function __construct($data = array())
	{
		$this->swiftMessage = \Swift_Message::newInstance();
		if (!empty($data)) {
			foreach ($data as $key => $value) {
				if ('message' === $key) {
					if (isset($value['html'])) $this->setHtml($value['html']);
					if (isset($value['text'])) $this->setText($value['text']);
				} else if ('decorators' === $key) {

				} else {
					$ucfKey = ucfirst($key);
					if (method_exists($this, "set{$ucfKey}")) $this->set{$ucfKey}($value);
				}
			}
		}
	}

	public function getTo()
	{
		return $this->to;
	}
	public function setTo($to)
	{
		$this->to = $to;
	}

	public function getCc()
	{
		return $this->to;
	}
	public function setCc($cc)
	{
		$this->cc = $cc;
	}

	public function getBcc()
	{
		return $this->to;
	}
	public function setBcc($bcc)
	{
		$this->bcc = $bcc;
	}

	public function getFrom()
	{
		return $this->from;
	}
	public function setFrom($from)
	{
		$this->from = $from;
	}

	public function getSubject()
	{
		return $this->subject;
	}
	public function setSubject($subject)
	{
		$this->subject = $subject;
	}

	public function getHtml()
	{
		return $this->html;
	}
	public function setHtml($html)
	{
		$this->html = $html;
	}

	public function getText()
	{
		return $this->text;
	}
	public function setText($text)
	{
		$this->text = $text;
	}

	public function getAttachments()
	{
		return $this->attachments;
	}
	public function setAttachments($attachments)
	{
		$this->attachments = $attachments;
	}
	public function addAttachment($attachment)
	{
		array_push($this->attachments, $attachment);
	}

	public function prepare()
	{
		foreach (get_object_vars($this) as $key => $value) {
			switch ($key) {
				case 'swiftMessage':
					break;
				case 'html':
				case 'text':
					if (null == $this->swiftMessage->getBody()) {
						$this->swiftMessage->setBody($value);
					} else {
						$this->swiftMessage->addPart($value);
					}
					break;
				case 'attachments':
					if (is_string($value)) {
						$this->swiftMessage->attach(
							\Swift_Attachment::fromPath($value)->setDisposition('inline')
						);
					} else if (is_array($value)) {
						foreach ($value as $name => $file) {
							$attachment = \Swift_Attachment::fromPath($file)->setDisposition('inline');
							if (is_string($name)) $attachment->setFilename($name);
							$this->swiftMessage->attach($attachment);
						}
					}
					break;
				default:
					$ucfKey = ucfirst($key);
					if (method_exists($this->swiftMessage, "set{$ucfKey}")) $this->swiftMessage->set{$ucfKey}($value);
					break;
			}
		}
		return $this->swiftMessage;
	}

	public function toArray()
	{
		return get_object_vars($this);
	}
}
