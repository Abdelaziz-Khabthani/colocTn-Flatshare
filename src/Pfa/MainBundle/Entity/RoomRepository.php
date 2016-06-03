<?php

namespace Pfa\MainBundle\Entity;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Tools\Pagination\Paginator;

/**
 * RoomRepository
 */
class RoomRepository extends EntityRepository
{
	public function getSimilarAdverts($town, $propertyType, $advertiserType, $targetGender, $id, $limit) {
		$qb = $this->createQueryBuilder('a')
		->leftJoin('a.targetPreference', 't')
		->addSelect('t');

		$qb->where('a.town = :town')
		->setParameter('town', $town)
		->andWhere('t.gender = :targetGender')
		->setParameter('targetGender', $targetGender)
		->andWhere('a.propertyType = :propertyType')
		->setParameter('propertyType', $propertyType)
		->andWhere('a.advertiserType = :advertiserType')
		->setParameter('advertiserType', $advertiserType)
		->andWhere('a.id != :id')
		->setParameter('id', $id)
		->orderBy('a.postDate', 'DESC');

		return $qb
		->getQuery()
		->setMaxResults($limit)
		->getResult();
	}

	public function simpleSearch($mode, $town, $gender, $budgetMin, $budgetMax, $page, $nbrPerPage) {
		$qb = $this->createQueryBuilder('a');
		$test = false;

		$qb->leftJoin('a.targetPreference', 'tp')
		->addSelect('tp')
		->leftJoin('tp.gender', 'g')
		->addSelect('g')
		->leftJoin('a.town', 't')
		->addSelect('t')
		->leftJoin('a.advertiserType', 'at')
		->addSelect('at');

		if (($town != null) && ($town != '')) {
			$qb->where('t.id = :town')
			->setParameter('town', $town);
			$test = true;
		}

		if ($mode == 0) {
			if ($test) {
				$qb->andWhere('at.name = :advertiserType')
				->setParameter('advertiserType', 'Propriétaire du bien');
			} else {
				$qb->where('at.name = :advertiserType')
				->setParameter('advertiserType', 'Propriétaire du bien');
				$test = true;
			}
		} elseif ($mode == 1) {
			if ($test) {
				$qb->andWhere('at.name = :advertiserType')
				->setParameter('advertiserType', 'Etudiant (Collocation)');
			} else {
				$qb->where('at.name = :advertiserType')
				->setParameter('advertiserType', 'Etudiant (Collocation)');
				$test = true;
			}
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

		// budget todo

		$qb->orderBy('a.postDate', 'DESC')->getQuery();

		$paginator = new Paginator($qb);

		$paginator->getQuery()
		->setFirstResult(($page-1) * $nbrPerPage)
		->setMaxResults($nbrPerPage);

		return $paginator;
	}

	public function getByUserId($id, $page, $nbrPerPage, $mode) {
		$qb = $this->createQueryBuilder('a')
		->leftJoin('a.advertiser', 'd')
		->addSelect('d')
		->leftJoin('a.advertiserType', 't')
		->addSelect('t');

		$qb->where('d.id = :id')
		->setParameter('id', $id);

		if ($mode == 0) {
			$qb->andWhere('t.name = :advertiserType')
			->setParameter('advertiserType', 'Propriétaire du bien');
		} else {
			$qb->andWhere('t.name = :advertiserType')
			->setParameter('advertiserType', 'Etudiant (Collocation)');
		}

		$qb->orderBy('a.postDate', 'DESC')->getQuery();
		$paginator = new Paginator($qb);

		$paginator->getQuery()
		->setFirstResult(($page-1) * $nbrPerPage)
		->setMaxResults($nbrPerPage);

		return $paginator;
	}

	public function findAllPage($page, $nbrPerPage, $mode) {
		$qb = $this->createQueryBuilder('a')
		->leftJoin('a.advertiserType', 't')
		->addSelect('t');

		$qb->orderBy('a.postDate', 'DESC');

		if ($mode == 0) {
			$qb->andWhere('t.name = :advertiserType')
			->setParameter('advertiserType', 'Propriétaire du bien');
		} else {
			$qb->andWhere('t.name = :advertiserType')
			->setParameter('advertiserType', 'Etudiant (Collocation)');
		}

		$paginator = new Paginator($qb);

		$paginator->getQuery()
		->setFirstResult(($page-1) * $nbrPerPage)
		->setMaxResults($nbrPerPage);

		return $paginator;
	}
}