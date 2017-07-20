<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

use ApiBundle\Repository\BaseRepository;

class ProductEntityRepository extends BaseRepository {
	protected $appId = null;
	protected $locale = null;

	protected $table = 'Recipe';
	protected $class = 'ApiBundle\\EntityMap\\Product';

	public function findById($id) {
		$queryBuilder = $this->createQueryBuilder('ApiBundle:ProductEntity');
		$queryBuilder = $this->addRelations($queryBuilder);

		$query = $queryBuilder
					->where('ApiBundle:ProductEntity.id = :id')
					->setParameter('id', $id)
					->getQuery();

		$result = $query->getOneOrNullResult(Query::HYDRATE_ARRAY);

		if ($result) {
			return $this->convertOne($result);
		}

		return null;
	}

	public function findByBrand($brandId) {
		$queryBuilder = $this->createQueryBuilder('ApiBundle:ProductEntity');
		$queryBuilder = $this->addRelations($queryBuilder);

		$query = $queryBuilder
					->where('ApiBundle:ProductEntity.brandId = :brandId')
					->setParameter('brandId', $brandId)
					->getQuery();

		$results = $query->getResult(Query::HYDRATE_ARRAY);

		return $this->convertAll($results);
	}

	public function findByFilters(array $filters) {
		$queryBuilder = $this->createQueryBuilder('ApiBundle:ProductEntity');
		$queryBuilder = $this->addRelations($queryBuilder);
		$queryBuilder = $this->addFilters($queryBuilder, $filters);

		$query = $queryBuilder
					->getQuery();

		$results = $query->getResult(Query::HYDRATE_ARRAY);

		return $this->convertAll($results);
	}

	private function addRelations($queryBuilder) {
		return $queryBuilder
				->addSelect('ApiBundle:ApplicationEntity')
				->leftJoin('ApiBundle:ProductEntity.application', 'ApiBundle:ApplicationEntity')

				->addSelect('ApiBundle:ColorEntity')
				->leftJoin('ApiBundle:ProductEntity.color', 'ApiBundle:ColorEntity')

				->addSelect('ApiBundle:SeasonEntity')
				->leftJoin('ApiBundle:ProductEntity.season', 'ApiBundle:SeasonEntity')

				->addSelect('ApiBundle:SegmentEntity')
				->leftJoin('ApiBundle:ProductEntity.segment', 'ApiBundle:SegmentEntity')

				->addSelect('ApiBundle:SubbrandEntity')
				->leftJoin('ApiBundle:ProductEntity.subbrand', 'ApiBundle:SubbrandEntity')

				->addSelect('ApiBundle:TechniqueEntity')
				->leftJoin('ApiBundle:ProductEntity.technique', 'ApiBundle:TechniqueEntity')

				->addSelect('ApiBundle:TestimonialEntity')
				->leftJoin('ApiBundle:ProductEntity.testimonial', 'ApiBundle:TestimonialEntity');
	}

	private function addFilters($queryBuilder, $filters) {
		foreach ($filters as $filter) {
			$queryBuilder
				->andWhere($filter['where'])
				->setParameter($filter['parameter'], $filter['value']);
		}

		return $queryBuilder;
	}
}