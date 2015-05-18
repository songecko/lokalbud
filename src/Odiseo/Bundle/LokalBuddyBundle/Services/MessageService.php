<?php

namespace Odiseo\Bundle\LokalBuddyBundle\Services;

use Odiseo\Bundle\EcommerceBundle\Services\BaseDbService;

class MessageService  extends BaseDbService
{
	private $mediaRepository; 
	private $userRepository;
	
	public function __construct($mediaRepository, $userRepository ){
		$this->mediaRepository = $mediaRepository;
		$this->userRepository = $userRepository;
	}
	
	public function findAllUnReadMessages(){
		
		
		
	}
	
	public function findMessageBetweenaDates(){
		
		
	}

}