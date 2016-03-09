<?php
namespace EmailTransport\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 * 		name="message"
 * )
 * @author Jordan Catibog
 */

class Message
{
	/** @ORM\Column(type="integer") 
     * @ORM\Id
     */
	protected $id;

    /** @ORM\Column(type="string") */
    protected $swiftmail_id;

    /** @ORM\Column(type="string") */
	protected $headers;

    /** @ORM\Column(type="string") */
    protected $from;

    /** @ORM\Column(type="string") */
    protected $to;

    /** @ORM\Column(type="string") */
    protected $cc;

    /** @ORM\Column(type="string") */
    protected $bcc;

    /** @ORM\Column(type="string") */
    protected $attachments;

    /** @ORM\Column(type="string") */
	protected $text;

    /** @ORM\Column(type="string") */
	protected $html;

    /** @ORM\Column(type="string") */
    protected $raw;

	/**
	 * @return the $id
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return the $headers
	 */
	public function getHeaders()
	{
		return $this->headers;
	}

	/**
	 * @param field_type $headers
	 */
	public function setHeaders($headers)
	{
		$this->headers = $headers;
	}

	/**
	 * @return the $text
	 */
	public function getText()
	{
		return $this->text;
	}

	/**
	 * @param field_type $text
	 */
	public function setText($text)
	{
		$this->text = $text;
	}

	/**
	 * @return the $html
	 */
	public function getHtml()
	{
		return $this->html;
	}

	/**
	 * @param field_type $html
	 */
	public function setHtml($html)
	{
		$this->html = $html;
	}

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Message
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Set swiftmailId
     *
     * @param string $swiftmailId
     *
     * @return Message
     */
    public function setSwiftmailId($swiftmailId)
    {
        $this->swiftmail_id = $swiftmailId;

        return $this;
    }

    /**
     * Get swiftmailId
     *
     * @return string
     */
    public function getSwiftmailId()
    {
        return $this->swiftmail_id;
    }

    /**
     * Set from
     *
     * @param string $from
     *
     * @return Message
     */
    public function setFrom($from)
    {
        $this->from = $from;

        return $this;
    }

    /**
     * Get from
     *
     * @return string
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * Set to
     *
     * @param string $to
     *
     * @return Message
     */
    public function setTo($to)
    {
        $this->to = $to;

        return $this;
    }

    /**
     * Get to
     *
     * @return string
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Set cc
     *
     * @param string $cc
     *
     * @return Message
     */
    public function setCc($cc)
    {
        $this->cc = $cc;

        return $this;
    }

    /**
     * Get cc
     *
     * @return string
     */
    public function getCc()
    {
        return $this->cc;
    }

    /**
     * Set bcc
     *
     * @param string $bcc
     *
     * @return Message
     */
    public function setBcc($bcc)
    {
        $this->bcc = $bcc;

        return $this;
    }

    /**
     * Get bcc
     *
     * @return string
     */
    public function getBcc()
    {
        return $this->bcc;
    }

    /**
     * Set attachments
     *
     * @param string $attachments
     *
     * @return Message
     */
    public function setAttachments($attachments)
    {
        $this->attachments = $attachments;

        return $this;
    }

    /**
     * Get attachments
     *
     * @return string
     */
    public function getAttachments()
    {
        return $this->attachments;
    }

    /**
     * Set raw
     *
     * @param string $raw
     *
     * @return Message
     */
    public function setRaw($raw)
    {
        $this->raw = $raw;

        return $this;
    }

    /**
     * Get raw
     *
     * @return string
     */
    public function getRaw()
    {
        return $this->raw;
    }
}
