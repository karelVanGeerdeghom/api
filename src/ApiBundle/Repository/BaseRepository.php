<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

use ApiBundle\Meta\Naming;

class BaseRepository extends EntityRepository
{
	use Naming;

	protected $appId = null;
	protected $locale = null;

	protected $filters = [];

	public function findByIds(array $ids) : array {
		$queryBuilder = $this->createQueryBuilder('ApiBundle:' . $this->class . 'Entity');
		$queryBuilder = $this->addRelations($queryBuilder);

		$query = $queryBuilder
					->andWhere('ApiBundle:' . $this->class . 'Entity.id IN (:id)')
					->setParameter('id', $ids)
					->getQuery();

		$results = $query->getResult(Query::HYDRATE_ARRAY);

		return $this->convertAll($results);
	}

	public function findByBrand(string $brandId) : array {
		$queryBuilder = $this->createQueryBuilder('ApiBundle:' . $this->class . 'Entity');
		$queryBuilder = $this->addRelations($queryBuilder);

		$query = $queryBuilder
					->where('ApiBundle:' . $this->class . 'Entity.brandId = :brandId')
					->setParameter('brandId', $brandId)
					->getQuery();

		$results = $query->getResult(Query::HYDRATE_ARRAY);

		return $this->convertAll($results);
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

	public function getLabels() : array {
		$columnTranslation = $this->getEntityManager()->getRepository('ApiBundle:ColumntranslationEntity')->findByAppTable($this->appId, $this->table);
		$valueTranslation = $this->getEntityManager()->getRepository('ApiBundle:ValuetranslationEntity')->findByAppTable($this->appId, $this->table);
		$fieldDescription = $this->getEntityManager()->getRepository('ApiBundle:FielddescriptionEntity')->findByTable($this->table);

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

	private function getClass() {
		$className = 'ApiBundle\\EntityMap\\' . $this->class;

		return new $className();
	}

	private function addRelations($queryBuilder) {
		$item = $this->getClass();

		foreach ($item->getRelations() as $relation => $properties) {
			$queryBuilder = $queryBuilder
								->addSelect('ApiBundle:' . $properties['class'] . 'Entity')
								->leftJoin('ApiBundle:' . $this->class . 'Entity.' . $relation, 'ApiBundle:' . $properties['class'] . 'Entity');
		}

		return $queryBuilder;
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
		
		$this->convertRelations($data);
		$this->nullifyData($data);

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

					array_push($relations, $relationItem->export());
				}

				$data[$relation] = $relations;
			}
		}
	}

	private function nullifyData(array &$data) {
		foreach ($data as $key => $value) {
			if (is_array($value)) {
				$this->nullifyData($value);
			} else {
				if ($value === '-1' || $value === -1) {
					$data[$key] = null;
				}
			}
		}
	}
}
