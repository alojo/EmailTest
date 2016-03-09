<?php
namespace EmailTransport\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 * 		name="errors"
 * )
 * @author Jordan Catibog
 */

class Error
{
	/** @ORM\Column(type="integer") 
     * @ORM\Id
     */
	protected $id;
	/** @ORM\Column(type="string") */
	protected $detail;

	/**
	 * @return the $id
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return the $detail
	 */
	public function getDetail()
	{
		return $this->detail;
	}

	/**
	 * @param field_type $detail
	 */
	public function setDetail($detail)
	{
		$this->detail = $detail;
	}


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Error
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
