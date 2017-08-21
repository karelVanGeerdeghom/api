<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\Query;

use ApiBundle\Meta\Transform;

class BaseRepository extends EntityRepository
{
	use Transform;

	protected $relations = [];
	protected $filters = [];

	protected $snapshots = [];
	protected $snapshotIds = [];
	protected $itemTranslations = [];
	protected $itemTranslationIds = [];

	public function findByIds(array $ids) : array {
		$this->createRelations($this->class);

		$queryBuilder = $this->createQueryBuilder('ApiBundle:' . $this->class . 'Entity');
		$queryBuilder = $this->addRelations($queryBuilder);

		$query = $queryBuilder
					->andWhere('ApiBundle:' . $this->class . 'Entity.id IN (:id)')
					->setParameter('id', $ids)
					->getQuery();

		$result = [
			strtolower($this->class) => $query->getResult(Query::HYDRATE_ARRAY)
		];

		$this->createSnapshots($this->class);
		$this->getSnapshotIds();

		$this->createItemTranslations($this->class);
		$this->getItemTranslationIds();

		$this->validateItems(strtolower($this->class), $result[strtolower($this->class)]);

		return $result;
	}

	public function findByBrand(string $brandId) : array {
		$this->createRelations($this->class);

		$queryBuilder = $this->createQueryBuilder('ApiBundle:' . $this->class . 'Entity');
		$queryBuilder = $this->addRelations($queryBuilder);

		$query = $queryBuilder
					->where('ApiBundle:' . $this->class . 'Entity.brandId = :brandId')
					->setParameter('brandId', $brandId)
					->getQuery();

		$result = [
			strtolower($this->class) => $query->getResult(Query::HYDRATE_ARRAY)
		];

		$this->createSnapshots($this->class);
		$this->getSnapshotIds();

		$this->createItemTranslations($this->class);
		$this->getItemTranslationIds();

		$this->validateItems(strtolower($this->class), $result[strtolower($this->class)]);

		return $result;
	}

	public function findByFilters(array $filters) : array {
		$this->createRelations($this->class);
		$this->createFilters($this->class, $filters);

		$queryBuilder = $this->createQueryBuilder('ApiBundle:' . $this->class . 'Entity');
		$queryBuilder = $this->addRelations($queryBuilder);
		$queryBuilder = $this->addFilters($queryBuilder);

		$query = $queryBuilder
					->getQuery();

		$result = [
			strtolower($this->class) => $query->getResult(Query::HYDRATE_ARRAY)
		];

		$this->createSnapshots($this->class);
		$this->createItemTranslations($this->class);

		$this->getSnapshotIds();
		$this->getItemTranslationIds();

		$this->validateItems(strtolower($this->class), $result[strtolower($this->class)]);

		return $result;
	}

	public function findIdsByFilters(array $filters) : array {
		$queryBuilder = $this->createQueryBuilder('ApiBundle:' . $this->class . 'Entity');

		$this->createRelations($this->class);
		$queryBuilder = $this->addRelations($queryBuilder);

		$this->createFilters($this->class, $filters);
		$queryBuilder = $this->addFilters($queryBuilder);

		$query = $queryBuilder
					->distinct()
					->select('ApiBundle:' . $this->class . 'Entity.id')
					->getQuery();

		return $this->toIdArray($query->getResult(Query::HYDRATE_ARRAY));
	}

	// <RELATIONS>
	private function createRelations(string $class, bool $isFilter = false) : void {
		$className = 'ApiBundle\\EntityMap\\' . $class;
		$item = new $className();

		foreach ($item->getRelations($isFilter) as $relation => $properties) {
			$this->createRelation($class, $relation, $properties['class']);
			if ($properties['fetch']) {
				$this->createRelations($properties['class'], $isFilter);
			}
		}
	}

	private function createRelation(string $joinee, string $relation, string $joiner) : void {
		$data = [
			'select' => 'ApiBundle:' . $joiner . 'Entity',
			'join' => 'ApiBundle:' . $joinee . 'Entity.' . $relation
		];

		array_push($this->relations, $data);
	}

	private function addRelations(QueryBuilder $queryBuilder) : QueryBuilder {
		foreach ($this->relations as $relation) {
			$queryBuilder = $queryBuilder
								->addSelect($relation['select'])
								->leftJoin($relation['join'], $relation['select']);
		}

		return $queryBuilder;
	}
	// </RELATIONS>

	// <SNAPSHOTS>
	private function createSnapshots(string $class) : void {
		$className = 'ApiBundle\\EntityMap\\' . $class;
		$item = new $className();

		if ($item->hasSnapshot()) {
			$this->createSnapshot($item->getClass());
		}

		foreach ($item->getRelations() as $relation => $properties) {
			if ($properties['fetch']) {
				$this->createSnapshots($properties['class']);
			}
		}
	}

	private function createSnapshot(string $class) : void {
		$this->snapshots[strtolower($class)] = $class;
	}

	private function getSnapshotIds() : void {
		foreach ($this->snapshots as $key => $class) {
			$queryBuilder = $this->getEntityManager()->getRepository('ApiBundle:Snapshot' . $class)->createQueryBuilder('ApiBundle:Snapshot' . $class);
			$query = $queryBuilder
							->select('ApiBundle:Snapshot' . $class . '.id')
							->where('ApiBundle:Snapshot' . $class . '.appId = :appId')
							->andWhere('ApiBundle:Snapshot' . $class . '.languageId = :languageId')
							->andWhere('ApiBundle:Snapshot' . $class . '.countryId = :countryId')
							->setParameter('appId', 1)
							->setParameter('languageId', 1)
							->setParameter('countryId', 1)
							->getQuery();

			$this->snapshotIds[$key] = [];
			foreach ($query->getResult(Query::HYDRATE_ARRAY) as $snapshot) {
				array_push($this->snapshotIds[$key], $snapshot['id']);
			}

			$this->snapshotIds[$key] = array_unique($this->snapshotIds[$key]);
		}
	}
	// </SNAPSHOTS>

	// <ITEMTRANSLATIONS>
	private function createItemTranslations(string $class, bool $isFilter = false) : void {
		$className = 'ApiBundle\\EntityMap\\' . $class;
		$item = new $className();

		if ($item->hasItemTranslation()) {
			$this->createItemTranslation($item->getClass(), $item->getTable());
		}

		foreach ($item->getRelations($isFilter) as $relation => $properties) {
			if ($properties['fetch']) {
				$this->createItemTranslations($properties['class']);
			}
		}
	}

	private function createItemTranslation(string $class, string $table) : void {
		$this->itemTranslations[strtolower($class)] = $table;
	}

	private function getItemTranslationIds() : void {
		foreach ($this->itemTranslations as $key => $table) {
			$queryBuilder = $this->getEntityManager()->getRepository('ApiBundle:ItemTranslationEntity')->createQueryBuilder('ApiBundle:ItemTranslationEntity');
			$query = $queryBuilder
							->select('ApiBundle:ItemTranslationEntity.tableId')
							->where('ApiBundle:ItemTranslationEntity.table = :table')
							->andWhere('ApiBundle:ItemTranslationEntity.languageId = :languageId')
							->andWhere('ApiBundle:ItemTranslationEntity.countryId = :countryId')
							->setParameter('table', $table)
							->setParameter('languageId', 1)
							->setParameter('countryId', 1)
							->getQuery();

			$this->itemTranslationIds[$key] = [];
			foreach ($query->getResult(Query::HYDRATE_ARRAY) as $itemTranslation) {
				if (!in_array($itemTranslation['tableId'], $this->itemTranslationIds[$key])) {
					array_push($this->itemTranslationIds[$key], $itemTranslation['tableId']);
				}				
			}
		}
	}
	// </ITEMTRANSLATIONS>

	// <FILTERS>
	private function createFilters(string $class, array $request) : void {
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

	private function createFilter(string $class, string $key, $value) : void {
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

	private function addFilters(QueryBuilder $queryBuilder) : QueryBuilder {
		foreach ($this->filters as $filter) {
			$queryBuilder
				->andWhere($filter['where'])
				->setParameter($filter['parameter'], $filter['value']);
		}

		return $queryBuilder;
	}
	// </FILTERS>

	private function validateItems(string $key, array &$result) : void {
		foreach ($result as &$value) {
			if (is_array($value)) {
				if ($this->validateItem($key, $value['id'])) {
					$result = [];
				}

				foreach ($value as $subKey => &$subValue) {
					if (is_array($subValue)) {
						if (count($subValue) > 0 && count($subValue) === count($subValue, COUNT_RECURSIVE)) {
							if ($this->validateItem($subKey, $subValue['id'])) {
								$subValue = null;
							}
						} else {
							$this->validateItems($subKey, $subValue);
						}
					}
				}
			}
		}
	}

	private function validateItem(string $key, string $id) : bool {
		if ((array_key_exists($key, $this->snapshotIds) && in_array($id, $this->snapshotIds[$key])) || (array_key_exists($key, $this->itemTranslationIds) && !in_array($id, $this->itemTranslationIds[$key]))) {
			return true;
		}

		return false;
	}
}
