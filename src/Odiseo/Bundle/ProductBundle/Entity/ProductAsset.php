<?php

namespace Odiseo\Bundle\ProductBundle\Entity;

use Symfony\Component\HttpFoundation\File\File;
use JsonSerializable;

/**
 * Asset
 */
class ProductAsset implements JsonSerializable
{
	protected $id;
    protected $product;
    
    /**
     * @var File $file
     */
    protected $file;
    protected $path;
    protected $position;
    protected $createdAt;
    protected $updatedAt;
    
    public function __construct()
    {
    	$this->createdAt = new \DateTime('now');
    }
    
	public function getId() 
	{
		return $this->id;
	}
	
	public function setId($id) 
	{
		$this->id = $id;
		return $this;
	}
	
	public function setFile(File $file = null)
	{
		$this->file = $file;
	
		if ($file) {
			// It is required that at least one field changes if you are using doctrine
			// otherwise the event listeners won't be called and the file is lost
			$this->updatedAt = new \DateTime('now');
		}
	}

	/**
	 * @return File
	 */
	public function getFile()
	{
		return $this->file;
	}
	
	public function getPath() 
	{
		return $this->path;
	}
	
	public function setPath($path) 
	{
		$this->path = $path;
		return $this;
	}
	
	public function getPosition() 
	{
		return $this->position;
	}
	
	public function setPosition($position) 
	{
		$this->position = $position;
		return $this;
	}
	
	public function getProduct() 
	{
		return $this->product;
	}
	
	public function setProduct($product) 
	{
		$this->product = $product;
		return $this;

	}	
	
	public function jsonSerialize()
	{
		return array(
				'id' => $this->id,
				'path' => $this->path,
		);
	}
}