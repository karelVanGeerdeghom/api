<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class BaseRepository extends EntityRepository
{
	protected $relations = [];

	public function findByIds(array $ids) : array {
		$this->createRelations($this->class);

		$queryBuilder = $this->createQueryBuilder('ApiBundle:' . $this->class . 'Entity');
		$queryBuilder = $this->addRelations($queryBuilder);

		$query = $queryBuilder
					->andWhere('ApiBundle:' . $this->class . 'Entity.id IN (:id)')
					->setParameter('id', $ids)
					->getQuery();

		return [
			'product' => $query->getResult(Query::HYDRATE_ARRAY)
		];
	}

	public function findByBrand(string $brandId) : array {
		$this->createRelations($this->class);

		$queryBuilder = $this->createQueryBuilder('ApiBundle:' . $this->class . 'Entity');
		$queryBuilder = $this->addRelations($queryBuilder);

		$query = $queryBuilder
					->where('ApiBundle:' . $this->class . 'Entity.brandId = :brandId')
					->setParameter('brandId', $brandId)
					->getQuery();

		return [
			'product' => $query->getResult(Query::HYDRATE_ARRAY)
		];
	}

	public function createRelations(string $class) {
		$className = 'ApiBundle\\EntityMap\\' . $class;
		$item = new $className();

		foreach ($item->getRelations() as $relation => $properties) {
			$this->createRelation($class, $relation, $properties['class']);
		}
	}

	public function createRelation(string $joinee, string $relation, string $joiner) {
		$data = [
			'select' => 'ApiBundle:' . $joiner . 'Entity',
			'join' => 'ApiBundle:' . $joinee . 'Entity.' . $relation,
			'to' => 'ApiBundle:' . $joiner . 'Entity'
		];

		array_push($this->relations, $data);

		$this->createRelations($joiner);
	}

	private function addRelations($queryBuilder) {
		foreach ($this->relations as $relation) {
			$queryBuilder = $queryBuilder
								->addSelect($relation['select'])
								->leftJoin($relation['join'], $relation['to']);
		}

		return $queryBuilder;
	}
}
