<?php

namespace Odiseo\Bundle\ProductBundle\Services;

use Odiseo\Bundle\EcommerceBundle\Filters\FilterFactory;
use Odiseo\Bundle\EcommerceBundle\Services\BaseDbService;

class BaseProductService extends BaseDbService
{
	private $productRepository; 
	private $extraRepository;
	private $productTypeRespository;
	private $productStateRepository;
	
	
	public function __construct($em  , $productRepository, $extraRepository , $productTypeRespository , $productStateRepository)
	{
		parent::__construct($em);
		$this->productRepository = $productRepository;
		$this->extraRepository = $extraRepository;
		$this->productTypeRespository = $productTypeRespository;
		$this->productStateRepository = $productStateRepository;	
	}
	
	public function findAll(){
		$all = $this->productRepository->findAll();
		return $all;
	}
	
	public function findAllTypes(){
		$this->productTypeRespository->findAll();
		$all  = $this->productTypeRespository->findAll();
		return $all;
	}
	
	public function findBy($key, $value){
		$products = $this->productRepository->findBy(array( $key => $value));
		return $products;
	}
	
	public function findOneBy($key, $value){
		$products = $this->productRepository->findOneBy(array( $key => $value));
		return $products;
	}
	
	public function addNewProduct($product, $producState){
		 $state = $this->productStateRepository->findOneByName($producState->getName());
		 $product->setState($state);
		 $this->save($product);
	}
	
	public function buildFilters($filters)
	{
		$searchFilters = array();
		
		foreach ($filters as $filterKey => $filterValue)
		{
			$filterType = null;
			
			if(in_array($filterKey, array('type', 'town')))
			{
				$filterType = FilterFactory::OR_FILTER_TYPE;
			}
			
			if(in_array($filterKey, array('price')))
			{
				$filterType = FilterFactory::RANGE_FILTER_TYPE;
				
				if($filterKey == 'price')
					$filterValue = explode(',', $filterValue);
			}			
			
			if($filterType != null)
			{
				$searchFilters[] = FilterFactory::getFilterInstance($filterType , array(
					'entityAlias' => 'p',
					'entityProperty' => $filterKey,
					'filterArgs' => is_array($filterValue)?array_values($filterValue):$filterValue
				));
			}
		}
		
		return $searchFilters;
	}
	
	public function findProductWithFilters($filters)
	{
		$searchFilters = $this->buildFilters($filters);
		
		return $this->productRepository->findProductWithFilters($searchFilters);
	}
	
	public function findProductWithFiltersPager($filters, $page = 1)
	{
		$searchFilters = $this->buildFilters($filters);
		
		return $this->productRepository->findProductWithFiltersPager($searchFilters, $page);
	}
}