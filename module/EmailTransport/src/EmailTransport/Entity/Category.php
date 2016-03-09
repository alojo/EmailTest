<?php
namespace EmailTransport\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Entity
 * @ORM\Table(
 * 		name="categories"
 * )
 * @author Jordan Catibog
 */

class Category
{
	/** 
    * @ORM\Column(type="integer") 
    * @ORM\Id
    */
	protected $id;
    
	/** @ORM\Column(type="string") */
	protected $description;
    
	/**
	 * @return the $id
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return the $description
	 */
	public function getDescription()
	{
		return $this->description;
	}

	/**
	 * @param field_type $description
	 */
	public function setDescription($description)
	{
		$this->description = $description;
	}


    /**
     * Set id
     *
     * @param integer $id
     *
     * @return Category
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}
