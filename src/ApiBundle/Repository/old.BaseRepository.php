<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

use ApiBundle\Meta\Name;

class old.BaseRepository extends EntityRepository
{
	use Name;

	protected $appId = null;
	protected $locale = null;

	protected $filters = [];
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

	public function findByFilters(array $request) : array {
		$this->createFilters($request);

		$queryBuilder = $this->createQueryBuilder('ApiBundle:' . $this->class . 'Entity');
		$queryBuilder = $this->addFilterRelations($queryBuilder);
		$queryBuilder = $this->addFilters($queryBuilder);

		$query = $queryBuilder
					->getQuery();

		$results = $query->getResult(Query::HYDRATE_ARRAY);

		return $this->convertAll($results);
	}

	public function findIdsByFilters(array $request) : array {
		$this->createFilters($request);

		$queryBuilder = $this->createQueryBuilder('ApiBundle:' . $this->class . 'Entity');
		$queryBuilder = $this->addFilterRelations($queryBuilder);
		$queryBuilder = $this->addFilters($queryBuilder);

		$query = $queryBuilder
					->distinct()
					->select('ApiBundle:' . $this->class . 'Entity.id')
					->getQuery();

		$results = $query->getResult(Query::HYDRATE_ARRAY);

		$ids = [];
		foreach ($results as $result) {
			array_push($ids, $result['id']);
		}

		return $ids;
	}

	public function getLabels(string $table) : array {
		$columnTranslation = $this->getEntityManager()->getRepository('ApiBundle:ColumntranslationEntity')->findByAppTable($this->appId, $table);
		$valueTranslation = $this->getEntityManager()->getRepository('ApiBundle:ValuetranslationEntity')->findByAppTable($this->appId, $table);
		$fieldDescription = $this->getEntityManager()->getRepository('ApiBundle:FielddescriptionEntity')->findByTable($table);

		return [
			'ColumnTranslation' => $columnTranslation,
			'ValueTranslation' => $valueTranslation,
			'FieldDescription' => $fieldDescription
		];
	}

	public function setAppId(string $appId) {
		$this->appId = $appId;
	}

	public function setLocale(string $locale) {
		$this->locale = $locale;
	}

	public function getTable() : string {
		return $this->table;
	}

	private function getClass() {
		$className = 'ApiBundle\\EntityMap\\' . $this->class;

		return new $className();
	}

	private function addFilterRelations($queryBuilder) {
		$item = $this->getClass();

		foreach ($item->getFilterRelations() as $relation => $properties) {
			$queryBuilder = $queryBuilder
								->addSelect('ApiBundle:' . $properties['class'] . 'Entity')
								->leftJoin('ApiBundle:' . $this->class . 'Entity.' . $relation, 'ApiBundle:' . $properties['class'] . 'Entity');
		}

		return $queryBuilder;
	}

	private function addFilters($queryBuilder) {
		foreach ($this->filters as $filter) {
			$queryBuilder
				->andWhere($filter['where'])
				->setParameter($filter['parameter'], $filter['value']);
		}

		return $queryBuilder;
	}

	private function createFilters(array $request) {
		$item = $this->getClass();
		$relations = $item->getRelations();

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

	private function convertOne(array $data) {
		$data = $this->camelCaseToUnderscore($data);
		$data = $this->nullify($data);

		$this->convertRelations($data);

		$item = $this->getClass();
		$item->set($data);

		return $item;
	}

	private function convertAll(array $results) : array {
		$items = [];

		foreach ($results as $data) {
			$items[$data['id']] = $this->convertOne($data);
		}

		return $items;
	}

	private function convertRelations(array &$data) {
		$item = $this->getClass();

		foreach ($item->getRelations() as $relation => $properties) {
			if (array_key_exists($relation, $data)) {
				if (!array_key_exists($relation, $data)) {
					$data[$relation] = [];
				}

				$relations = [];
				foreach ($data[$relation] as $relationData) {
					$className = 'ApiBundle\\EntityMap\\' . $properties['class'];
					$relationItem = new $className;
					$relationItem->set($relationData);

					$labels = $this->getLabels($relationItem->getTable());
					$relationItem->setLabels($labels);

					array_push($relations, $relationItem->export());
				}

				$data[$relation] = $relations;
			}
		}
	}

	private function nullify(array $data) {
		$result = [];

		foreach ($data as $key => $value) {
			if (is_array($value)) {
				$result[$key] = $this->nullify($value);
			} else {
				$result[$key] = $value === '-1' || $value === -1 ? null : $value;
			}
		}

		return $result;
	}
}
