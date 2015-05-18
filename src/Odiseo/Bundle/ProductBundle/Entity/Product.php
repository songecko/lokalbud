<?php

namespace Odiseo\Bundle\ProductBundle\Entity;

use DateTime;
use JsonSerializable;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * MediaState
 */
class Product implements JsonSerializable
{
    /**
     * @var integer
     */
    private $id;
    private $title;
    private $shortDescription;
    private $description;
    private $price;
    private $oldPrice;
    private $dateCreated;
    private $vendor;
    private $state;
    private $quantity;
    private $type;
    private $town;
    private $assets;
    private $latitud;
    private $longitud;
    private $address;
    
    public function __construct()
    {
    	$this->dateCreated = new DateTime('now');
    	$this->assets = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    public function setId($id){
    	$this->id = $id;
    }
	public function getTitle() {
		return $this->title;
	}
	public function setTitle($title) {
		$this->title = $title;
		return $this;
	}
	public function getDescription() {
		return $this->description;
	}
	public function setDescription($description) {
		$this->description = $description;
		return $this;
	}
	public function getPrice() {
		return $this->price;
	}
	public function setPrice($price) {
		$this->price = $price;
		return $this;
	}
	public function getDateCreated() {
		return $this->dateCreated;
	}
	public function setDateCreated($dateCreated) {
		$this->dateCreated = $dateCreated;
		return $this;
	}
	public function getVendor() {
		return $this->vendor;
	}
	public function setVendor($vendor) {
		$this->vendor = $vendor;
		return $this;
	}
	public function getState() {
		return $this->state;
	}
	public function setState($state) {
		$this->state = $state;
		return $this;
	}
	public function getQuantity() {
		return $this->quantity;
	}
	public function setQuantity($quantity) {
		$this->quantity = $quantity;
		return $this;
	}
	public function getType() {
		return $this->type;
	}
	public function setType($type) {
		$this->type = $type;
		return $this;
	}
	
	public function jsonSerialize()
	{
		return array(	
				'title' => $this->title,
				'id' => $this->id,
				'title' => $this->title,
				'description' => $this->description,
				'shortDescription' => $this->shortDescription,
				'price' => $this->price,
				'oldPrice' => $this->oldPrice,
				'dateCreated' => $this->dateCreated,
				'vendorId' => $this->vendor->getId(),
				'state' => $this->state->getName(),
				'typeId' => $this->type->getId(),
				'typeDescription' => $this->type->getDescription(),
				'latitud' => $this->latitud,
				'longitud' => $this->longitud,
				'mainAsset' => $this->getMainAsset()
		);
	}
	public function getShortDescription() {
		return $this->shortDescription;
	}
	public function setShortDescription($shortDescription) {
		$this->shortDescription = $shortDescription;
		return $this;
	}
	public function getOldPrice() {
		return $this->oldPrice;
	}
	public function setOldPrice($oldPrice) {
		$this->oldPrice = $oldPrice;
		return $this;
	}
	
	public function getTown() {
		return $this->town;
	}
	
	public function setTown($town) {
		$this->town = $town;
		return $this;
	}
	public function getAssets() {
		return $this->assets;
	}
	public function setAssets($assets) {
		$this->assets = $assets;
		return $this;
	}
	
	public function addAsset(ProductAsset $asset)
	{
		$asset->setProduct($this);
	
		if (!$this->assets->contains($asset)) {
			$this->assets->add($asset);
		}
	}
	
	public function removeAsset(ProductAsset $asset)
	{
		if ($this->assets->contains($asset)) {
			$this->assets->removeElement($asset);
		}
	}
	
	public function getLatitud() {
		return $this->latitud;
	}
	public function setLatitud($latitud) {
		$this->latitud = $latitud;
		return $this;
	}
	
	public function getLongitud() {
		return $this->longitud;
	}
	public function setLongitud($longitud) {
		$this->longitud = $longitud;
		return $this;
	}

	public function getAddress() {
		return $this->address;
	}
	public function setAddress($address) {
		$this->address = $address;
		return $this;
	}
	
	public function getMainAsset()
	{
		if($this->assets && count($this->assets) > 0)
		{
			return $this->assets[0];
		}
		
		return null;
	}
	
}

