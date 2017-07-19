<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

use ApiBundle\Repository\BaseRepository;

class ProductEntityRepository extends BaseRepository {
	protected $appId = null;
	protected $locale = null;

	protected $table = 'Recipe';
	protected $class = 'ApiBundle\\Type\\Product';

	public function findById($id) {
		$result = $this->getEntityManager()
						->createQuery('SELECT r FROM ApiBundle:ProductEntity r WHERE r.id = :id')
						->setParameter('id', $id)
						->getOneOrNullResult(Query::HYDRATE_ARRAY);

		if ($result) {
			return $this->convertOne($result);
		}

		return null;
	}

	public function findByBrand($brandId) {
		$results = $this->getEntityManager()
						->createQuery('SELECT r FROM ApiBundle:ProductEntity r WHERE r.brandId = :brandId')
						->setParameter('brandId', $brandId)
						->getResult(Query::HYDRATE_ARRAY);

		return $this->convertAll($results);
	}
}