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

/*return [
	'relations' => $this->relations,
	'filters' => $this->filters
];*/

		$queryBuilder = $this->createQueryBuilder('ApiBundle:' . $this->class . 'Entity');
		$queryBuilder = $this->addRelations($queryBuilder);
		$queryBuilder = $this->addFilters($queryBuilder);

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

		$relations = $item->getRelations();

		foreach ($relations as $relation => $properties) {
			if ($properties['filter'] === 'enum') {
				if (array_key_exists($relation, $request)) {
					$this->createFilter($properties['class'], 'id', $request[$relation]);

					unset($request[$relation]);
				}
			}

			if ($properties['filter'] === 'relation') {
				$relationClassName = 'ApiBundle\\EntityMap\\' . $properties['class'];
				$relationItem = new $relationClassName();

				$relationFilters = $relationItem->getFilters();
				foreach ($relationItem->getFilters() as $relationFilter) {
					if (array_key_exists($relationFilter, $request)) {
						$this->createFilter($properties['class'], $relationFilter, $request[$relationFilter]);

						unset($request[$relationFilter]);
					}
				}
			}
		}

		foreach ($request as $key => $value) {
			$this->createFilter($class, $key, $value);
		}
	}

	private function createFilter(string $class, string $key, $value) {
		$compareKey = $class . 'Entity.' . $this->underscoreToCamelCase($key);

		if (is_array($value)) {
			if (array_key_exists('min', $value) || array_key_exists('max', $value)) {
				if (array_key_exists('min', $value)) {
					$filter = [
						'where' => 'ApiBundle:' . $compareKey . ' >= :' . $key . '_min',
						'parameter' => $key . '_min',
						'value' => $value['min']
					];

					array_push($this->filters, $filter);
				}
				if (array_key_exists('max', $value)) {
					$filter = [
						'where' => 'ApiBundle:' . $compareKey . ' <= :' . $key . '_max',
						'parameter' => $key . '_max',
						'value' => $value['max']
					];

					array_push($this->filters, $filter);
				}
			} else {
				$filter = [
					'where' => 'ApiBundle:' . $compareKey . ' IN (:' . $key . ')',
					'parameter' => $key,
					'value' => $value
				];

				array_push($this->filters, $filter);
			}
		} else {
			$filter = [
				'where' => 'ApiBundle:' . $compareKey . ' = :' . $key,
				'parameter' => $key,
				'value' => $value
			];

			array_push($this->filters, $filter);
		}
	}

	private function addFilters($queryBuilder) {
		foreach ($this->filters as $filter) {
			$queryBuilder
				->andWhere($filter['where'])
				->setParameter($filter['parameter'], $filter['value']);
		}

		return $queryBuilder;
	}

	private function underscoreToCamelCase(string $string) : string {
		return lcfirst(preg_replace_callback('/(^|_|\.)+(.)/', function ($match) {
			return ('.' === $match[1] ? '_' : '').strtoupper($match[2]);
		}, $string));
	}
}
