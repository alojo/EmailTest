<?php
namespace EmailTransport\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 * 		name="history"
 * )
 * @author Jordan Catibog
 */
class Sent
{
	/**
	 * @ORM\Column(type="integer", unique=true)
     * @ORM\Id
	 * @ORM\GeneratedValue
	 */
	protected $id;
	/** @ORM\Column(type="integer") */
	protected $category_id;
	/** @ORM\Column(type="integer") */
	protected $client_id;
	/** @ORM\Column(type="integer") */
	protected $magazine_id;
	/** @ORM\Column(type="integer") */
	protected $message_id;
	/** @ORM\Column(type="integer") */
	protected $error_id;
	/** @ORM\Column(type="datetime") */
	protected $date_sent;

	public function getId()
	{
		return $this->id;
	}

	public function getCategoryId()
	{
		return $this->category_id;
	}
	public function setCategoryId($id)
	{
		$this->category_id = $id;
	}

	public function getClientId()
	{
		return $this->client_id;
	}
	public function setClientId($id)
	{
		$this->client_id = $id;
	}

	public function getMagazineId()
	{
		return $this->magazine_id;
	}
	public function setMagazineId($id)
	{
		$this->magazine_id = $id;
	}

	public function getMessageId()
	{
		return $this->email_body_id;
	}
	public function setMessageId($id)
	{
		$this->message_id = $id;
	}

	public function getErrorId()
	{
		return $this->error_id;
	}
	public function setErrorId($id)
	{
		$this->error_id = $id;
	}

	public function getDateSent()
	{
		return $this->date_sent;
	}
	public function setDateSent($date)
	{
		$this->date_sent = $date;
	}
}

?>
