<?php

namespace Odiseo\Bundle\EcommerceBundle\Filters;

use Doctrine\ORM\Query\Expr;

/**
 * State
 */
class  WhereQueryBuilder
{
	public  static function getQuery($qb, $entityName, $filters)
	{
		$withFilters = is_array($filters) && count($filters) > 0;
		$entityAlias = $withFilters?$filters[0]->getEntityAlias():'e';
		
		$qb = $qb->select($entityAlias)
			->from($entityName, $entityAlias);
		
		if($withFilters)
		{
			$qb->where($filters[0]->getExpression());
		
			for ($i = 1; $i < count($filters) ; $i++)
			{
				$qb->andWhere($filters[$i]->getExpression());
			}
		}
		
		return $qb->getQuery();
	}   
}