<?php

namespace Odiseo\Bundle\EcommerceBundle\Services;

class BaseDbService
{
	protected $em;
	protected $mainRepositoryName;

	protected function __construct($em)
	{
		$this->em = $em;
	}

	public function save($entity)
	{
		$this->em->persist($entity);
		$this->em->flush($entity);
	}
	
	protected function update($entity)
	{
		$this->em->persist($entity);
		$this->em->flush($entity);
	}
	
	protected function saveOrUpdate($entity)
	{
		$this->em->persist($entity);
		$this->em->flush($entity);
	}
}