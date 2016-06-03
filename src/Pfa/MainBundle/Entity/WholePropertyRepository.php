<?php

namespace Pfa\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * WholePropertyRepository
 */
class WholePropertyRepository extends EntityRepository
{
	public function getSimilarAdverts($price, $town, $propertyType, $id, $limit) {
		$qb = $this->createQueryBuilder('a');

		$qb->where('a.price BETWEEN :min AND :max')
		->setParameter(':min', $price - 50)
		->setParameter(':max', $price + 50)
		->andWhere('a.town = :town')
		->setParameter('town', $town)
		//->andWhere('a.propertyType = :propertyType')
		//->setParameter('propertyType', $propertyType)
		->andWhere('a.id != :id')
		->setParameter('id', $id)
		->orderBy('a.postDate', 'DESC');

		return $qb
		->getQuery()
		->setMaxResults($limit)
		->getResult();
	}

	public function simpleSearch($town, $gender, $budgetMin, $budgetMax, $page, $nbrPerPage) {
		$qb = $this->createQueryBuilder('a');
		$test = false;

		$qb->leftJoin('a.targetPreference', 'tp')
		->addSelect('tp')
		->leftJoin('tp.gender', 'g')
		->addSelect('g')
		->leftJoin('a.town', 't')
		->addSelect('t');

		if (($town != null) && ($town != '')) {
			$qb->where('t.id = :town')
			->setParameter('town', $town);
			$test = true;
		}

		if (($gender != null) && ($gender != '')) {
			if ($test) {
				$qb->andWhere('g.id = :gender')
				->setParameter('gender', $gender);
			} else {
				$qb->where('g.id = :gender')
				->setParameter('gender', $gender);
				$test = true;
			}
		}

		if ((($budgetMin != null) && ($budgetMin != '')) && (($budgetMax != null) && ($budgetMax != ''))) {
			if ($test) {
				$qb->andwhere('a.price BETWEEN :min AND :max')
				->setParameter('min', $budgetMin)
				->setParameter('max', $budgetMax);
			} else {
				$qb->where('a.price BETWEEN :min AND :max')
				->setParameter('min', $budgetMin)
				->setParameter('max', $budgetMax);
				$test = true;
			}
		}

		$qb->orderBy('a.postDate', 'DESC')->getQuery();

		$paginator = new Paginator($qb);

		$paginator->getQuery()
		->setFirstResult(($page-1) * $nbrPerPage)
		->setMaxResults($nbrPerPage);

		return $paginator;
	}

	public function getByUserId($id, $page, $nbrPerPage) {
		$qb = $this->createQueryBuilder('a')
		->leftJoin('a.advertiser', 'd')
		->addSelect('d');

		$qb->where('d.id = :id')
		->setParameter('id', $id);

		$qb->orderBy('a.postDate', 'DESC')->getQuery();
		$paginator = new Paginator($qb);
		
		$paginator->getQuery()
		->setFirstResult(($page-1) * $nbrPerPage)
		->setMaxResults($nbrPerPage);

		return $paginator;
	}

	public function findAllPage($page, $nbrPerPage) {
		$qb = $this->createQueryBuilder('a');
		$qb->orderBy('a.postDate', 'DESC');
		$paginator = new Paginator($qb);
		$paginator->getQuery()
		->setFirstResult(($page-1) * $nbrPerPage)
		->setMaxResults($nbrPerPage);
		return $paginator;
	}
}