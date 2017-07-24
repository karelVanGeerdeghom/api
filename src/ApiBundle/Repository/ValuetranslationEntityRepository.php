<?php
namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class ValuetranslationEntityRepository extends EntityRepository
{
	public function findByAppTable($appId, string $table) : array {
		$valueTranslations = [];

		$results = $this->getEntityManager()
						->createQuery('SELECT vt FROM ApiBundle:ValuetranslationEntity vt WHERE vt.appId = :appId AND vt.table = :table')
						->setParameter('appId', $appId)
						->setParameter('table', $table)
						->getResult(Query::HYDRATE_ARRAY);

		foreach ($results as $result) {
			if (!array_key_exists($result['column'], $valueTranslations)) {
				$valueTranslations[$result['column']] = [];
			}
			$valueTranslations[$result['column']][$result['value']] = $result['labelTid'];
		}

		return $valueTranslations;
	}
}