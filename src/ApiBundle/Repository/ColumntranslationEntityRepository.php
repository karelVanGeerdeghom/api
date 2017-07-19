<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class ColumntranslationEntityRepository extends EntityRepository {
	public function findByAppTable($appId, string $table) : array {
		$columnTranslations = [];

		$results = $this->getEntityManager()
						->createQuery('SELECT ct FROM ApiBundle:ColumntranslationEntity ct WHERE ct.appId = :appId AND ct.table = :table')
						->setParameter('appId', $appId)
						->setParameter('table', $table)
						->getResult(Query::HYDRATE_ARRAY);

		foreach ($results as $result) {
			$columnTranslations[$result['column']] = $result['labelTid'];
		}

		return $columnTranslations;
	}
}