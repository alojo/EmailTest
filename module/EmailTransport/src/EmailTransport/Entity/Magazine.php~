<?php
namespace EmailTransport\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 * 		name="magazines"
 * )
 * @author Jordan Catibog
 */

class Magazine
{
	/** @ORM\Column(type="integer") 
     * @ORM\Id
     */
	protected $id;
	/** @ORM\Column(type="string") */
	protected $magabbr;
	/** @ORM\Column(type="string") */
	protected $name;

	/**
	 * @return the $id
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return the $magabbr
	 */
	public function getMagabbr()
	{
		return $this->magabbr;
	}

	/**
	 * @param field_type $magabbr
	 */
	public function setMagabbr($magabbr)
	{
		$this->magabbr = $magabbr;
	}

	/**
	 * @return the $name
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param field_type $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Magazine
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
