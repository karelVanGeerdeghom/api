<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class BaseRepository extends EntityRepository
{
	protected $relations = [];
	protected $filters = [];

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

	public function findByFilters(array $parameters) : array {
		$this->createRelations($this->class, true);
		$this->createFilters($this->class, $parameters);

		$className = 'ApiBundle\\EntityMap\\Product';
		$item = new $className();
return $item->getRelations(true);

return $this->filters;
		$queryBuilder = $this->createQueryBuilder('ApiBundle:' . $this->class . 'Entity');
		$queryBuilder = $this->addRelations($queryBuilder);

		$query = $queryBuilder
					->andWhere('ApiBundle:' . $this->class . 'Entity.id IN (:id)')
					->setParameter('id', [9887])
					->getQuery();

		return [
			'product' => $query->getResult(Query::HYDRATE_ARRAY)
		];
	}

	private function createRelations(string $class, bool $isFilter = false) {
		$className = 'ApiBundle\\EntityMap\\' . $class;
		$item = new $className();

		foreach ($item->getRelations($isFilter) as $relation => $properties) {
			$this->createRelation($class, $relation, $properties['class']);

			$this->createRelations($properties['class'], $isFilter);
		}
	}

	private function createRelation(string $joinee, string $relation, string $joiner) {
		$data = [
			'select' => 'ApiBundle:' . $joiner . 'Entity',
			'join' => 'ApiBundle:' . $joinee . 'Entity.' . $relation,
			'to' => 'ApiBundle:' . $joiner . 'Entity'
		];

		array_push($this->relations, $data);
	}

	private function addRelations($queryBuilder) {
		foreach ($this->relations as $relation) {
			$queryBuilder = $queryBuilder
								->addSelect($relation['select'])
								->leftJoin($relation['join'], $relation['to']);
		}

		return $queryBuilder;
	}

	private function createFilters(string $class, array $request) {
		$className = 'ApiBundle\\EntityMap\\' . $class;
		$item = new $className();

		$relations = $item->getRelations(true);
		foreach ($request as $key => $value) {
			if (array_key_exists($key, $relations)) {
				$this->createFilter($key, $value, $relations[$key]['class']);
			} else {
				$this->createFilter($key, $value);
			}
		}
	}

	private function createFilter(string $key, $value, $relation = null) {
		$parameter = $this->underscoreToCamelCase($key);

		$compareKey = $this->class . 'Entity.' . $parameter;
		if ($relation) {
			$compareKey = $relation . 'Entity.id';
		}

		if (is_array($value)) {
			if (array_key_exists('min', $value) || array_key_exists('max', $value)) {
				if (array_key_exists('min', $value)) {
					$filter = [
						'where' => 'ApiBundle:' . $compareKey . ' >= :' . $parameter . '_min',
						'parameter' => $parameter . '_min',
						'value' => $value['min']
					];

					array_push($this->filters, $filter);
				}
				if (array_key_exists('max', $value)) {
					$filter = [
						'where' => 'ApiBundle:' . $compareKey . ' <= :' . $parameter . '_max',
						'parameter' => $parameter . '_max',
						'value' => $value['max']
					];

					array_push($this->filters, $filter);
				}
			} else {
				$filter = [
					'where' => 'ApiBundle:' . $compareKey . ' IN (:' . $parameter . ')',
					'parameter' => $this->underscoreToCamelCase($key),
					'value' => $value
				];

				array_push($this->filters, $filter);
			}
		} else {
			$filter = [
				'where' => 'ApiBundle:' . $compareKey . ' = :' . $parameter,
				'parameter' => $this->underscoreToCamelCase($key),
				'value' => $value
			];

			array_push($this->filters, $filter);
		}
	}

	private function underscoreToCamelCase(string $string) : string {
		return lcfirst(preg_replace_callback('/(^|_|\.)+(.)/', function ($match) {
			return ('.' === $match[1] ? '_' : '').strtoupper($match[2]);
		}, $string));
	}
}
