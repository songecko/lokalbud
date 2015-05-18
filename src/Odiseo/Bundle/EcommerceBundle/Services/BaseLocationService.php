<?php

namespace Odiseo\Bundle\EcommerceBundle\Services;

class BaseLocationService extends BaseDbService
{
	protected $em;
	protected $townRespository;
	protected $regionRepository;

	public function __construct($em , $townRespository , $regionRepository)
	{
		$this->em = $em;
		$this->regionRepository = $regionRepository;
		$this->townRespository = $townRespository;
	}
	
	public function  findAllTowns()
	{
		return $this->townRespository->findAll();
	}
	
	public function findAllRegions()
	{
		return $this->regionRepository->findAll();
	}
	
	public function findTownsByRegions($regionId)
	{
		return $this->townRespository->findByRegion($regionId);	
	}
}