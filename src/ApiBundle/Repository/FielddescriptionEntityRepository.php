<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class FielddescriptionEntityRepository extends EntityRepository
{
	public function findByTable(string $table) : array {
		$fieldDescriptions = [];

		$results = $this->getEntityManager()
						->createQuery('SELECT fd FROM ApiBundle:FielddescriptionEntity fd WHERE fd.tablename = :tablename')
						->setParameter('tablename', $table)
						->getResult(Query::HYDRATE_ARRAY);

		foreach ($results as $result) {
			$fieldDescriptions[$result['fieldname']] = $result['descriptionTid'];
		}

		return $fieldDescriptions;
	}
}