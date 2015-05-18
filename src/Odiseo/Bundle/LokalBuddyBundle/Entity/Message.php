<?php

namespace Odiseo\Bundle\LokalBuddyBundle\Entity;

use DateTime;
/**
 * Message
 */
class Message
{
	
	private $id;
    private $subject;
    private $body;
    private $isReaded;
    private $isSent;
    private $isDeleted;
	private $dateCreated;
	private $sender;
	private $receiver;
	private $product;
	
	
    public function __construct()
    {
    	$this->dateCreated = new DateTime('now');
    }
	
	
	public function getId() {
		return $this->id;
	}
	public function setId($id) {

		$this->id = $id;
		return $this;
	}

	public function getSubject() {
		return $this->subject;
	}

	public function setSubject($subject) {
		$this->subject = $subject;
		return $this;
	}

	public function getBody() {
		return $this->body;
	}

	public function setBody($body) {
		$this->body = $body;
		return $this;
	}

	public function getIsReaded() {
		return $this->isReaded;
	}

	public function setIsReaded($isReaded) {
		$this->isReaded = $isReaded;
		return $this;
	}

	public function getIsSent() {
		return $this->isSent;
	}

	public function setIsSent($isSent) {
		$this->isSent = $isSent;
		return $this;
	}

	public function getIsDeleted() {
		return $this->isDeleted;
	}
	
	public function setIsDeleted($isDeleted) {
		$this->isDeleted = $isDeleted;
		return $this;
	}
	
	public function isDeleted(){
		return $this->getIsDeleted();
	}
	
	public function isSent(){
		return $this->getIsSent();
	}
	
	public function isReaded(){
		return $this->getIsReaded();
	}
	
	public function getDateCreated() {
		return $this->dateCreated;
	}
	
	public function setDateCreated($dateCreated) {
		$this->dateCreated = $dateCreated;
		return $this;
	}
	public function getSender() {
		return $this->sender;
	}
	public function setSender($sender) {
		$this->sender = $sender;
		return $this;
	}
	public function getReceiver() {
		return $this->receiver;
	}
	public function setReceiver($receiver) {
		$this->receiver = $receiver;
		return $this;
	}
	
	
	public function getProduct() {
		return $this->product;
	}
	public function setProduct($product) {
		$this->product = $product;
		return $this;
	}
	
	
	
	
}

