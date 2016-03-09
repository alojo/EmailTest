<?php
namespace EmailTransport\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 * 		name="confirmation"
 * )
 * @author Jordan Catibog
 */

class Confirmation
{
	/** @ORM\Column(type="integer") 
    *   @ORM\Id
    */
	protected $id;
	/** @ORM\Column(type="integer") */
	protected $sent_id;

	/**
	 * @return the $id
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return the $sent_id
	 */
	public function getSentId()
	{
		return $this->sent_id;
	}

	/**
	 * @param field_type $sent_id
	 */
	public function setSentId($sent_id)
	{
		$this->sent_id = $sent_id;
	}

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Confirmation
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
