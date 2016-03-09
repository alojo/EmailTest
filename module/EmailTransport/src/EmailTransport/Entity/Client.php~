<?php
namespace EmailTransport\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(
 * 		name="clients"
 * )
 * @author Jordan Catibog
 */

class Client
{
	/** 
    * @ORM\Column(type="integer") 
    * @ORM\Id
    */
	protected $id;
    
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
     * @return Client
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
