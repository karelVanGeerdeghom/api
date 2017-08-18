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
	protected $snapshots = [];
	protected $itemTranslations = [];
	protected $filters = [];

	protected $parameters = [];

	public function findByIds(array $ids) : array {
		$queryBuilder = $this->prepareQueryBuilder();

		$query = $queryBuilder
					->andWhere('ApiBundle:' . $this->class . 'Entity.id IN (:id)')
					->setParameter('id', $ids)
					->getQuery();

		return [
			strtolower($this->class) => $query->getResult(Query::HYDRATE_ARRAY)
		];
	}

	public function findByBrand(string $brandId) : array {
		$queryBuilder = $this->prepareQueryBuilder();

		$query = $queryBuilder
					->where('ApiBundle:' . $this->class . 'Entity.brandId = :brandId')
					->setParameter('brandId', $brandId)
					->getQuery();

		return [
			strtolower($this->class) => $query->getResult(Query::HYDRATE_ARRAY)
		];
	}

	public function findByFilters(array $filters) : array {
		$queryBuilder = $this->prepareQueryBuilder(true);

		$this->createFilters($this->class, $filters);
		$queryBuilder = $this->addFilters($queryBuilder);

		$query = $queryBuilder
					->getQuery();

		return [
			strtolower($this->class) => $query->getResult(Query::HYDRATE_ARRAY)
		];
	}

	public function findIdsByFilters(array $filters) : array {
		$queryBuilder = $this->prepareQueryBuilder(true);

		$this->createFilters($this->class, $filters);
		$queryBuilder = $this->addFilters($queryBuilder);

		$query = $queryBuilder
					->distinct()
					->select('ApiBundle:' . $this->class . 'Entity.id')
					->getQuery();

		return $this->toIdArray($query->getResult(Query::HYDRATE_ARRAY));
	}

	// <QUERYBUILDER>
	private function prepareQueryBuilder(bool $isFilter = false) : QueryBuilder {
		$this->createParameter('appId', 10);
		$this->createParameter('languageId', 1);
		$this->createParameter('countryId', 1);

		$this->createRelations($this->class, $isFilter);
		$this->createSnapshots($this->class);
		$this->createItemTranslations($this->class, $isFilter);

		$queryBuilder = $this->createQueryBuilder('ApiBundle:' . $this->class . 'Entity');
		$queryBuilder = $this->addRelations($queryBuilder);
		$queryBuilder = $this->addSnapshots($queryBuilder);
		$queryBuilder = $this->addItemTranslations($queryBuilder);
		$queryBuilder = $this->addParameters($queryBuilder);

		return $queryBuilder;
	}
	// </QUERYBUILDER>

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
			$this->createSnapshot($class);
		}

		foreach ($item->getRelations() as $relation => $properties) {
			if ($properties['fetch']) {
				$this->createSnapshots($properties['class']);
			}
		}
	}

	private function createSnapshot(string $class) : void {
		array_push($this->snapshots, $class);
	}

	private function addSnapshots(QueryBuilder $queryBuilder) : QueryBuilder {
		foreach ($this->snapshots as $class) {
			$subQueryBuilder = $this->getEntityManager()->getRepository('ApiBundle:Snapshot' . $class)->createQueryBuilder('ApiBundle:Snapshot' . $class);
			$subQuery = $subQueryBuilder
						->where('ApiBundle:' . $class . 'Entity.id = ApiBundle:Snapshot' . $class . '.id')
						->andWhere('ApiBundle:Snapshot' . $class . '.appId = :appId')
						->andWhere('ApiBundle:Snapshot' . $class . '.languageId = :languageId')
						->andWhere('ApiBundle:Snapshot' . $class . '.countryId = :countryId');

			$queryBuilder->andWhere($queryBuilder->expr()->not($queryBuilder->expr()->exists($subQuery->getDQL())));
		}

		return $queryBuilder;
	}
	// </SNAPSHOTS>

	// <ITEMTRANSLATIONS>
	private function createItemTranslations(string $class, bool $isFilter = false) : void {
		$className = 'ApiBundle\\EntityMap\\' . $class;
		$item = new $className();

		if ($item->hasItemTranslation()) {
			$this->createItemTranslation($class, $item->getTable());
		}

		foreach ($item->getRelations($isFilter) as $relation => $properties) {
			if ($properties['fetch']) {
				$this->createItemTranslations($properties['class']);
			}
		}
	}

	private function createItemTranslation(string $class, string $table) : void {
		$this->itemTranslations[$class] = $table;
	}

	private function addItemTranslations(QueryBuilder $queryBuilder) : QueryBuilder {
		foreach ($this->itemTranslations as $class => $table) {
			$this->createParameter($class . 'Table', $table);

			$subQueryBuilder = $this->getEntityManager()->getRepository('ApiBundle:ItemTranslation' . $class . 'Entity')->createQueryBuilder('ApiBundle:ItemTranslation' . $class . 'Entity');
			$subQuery = $subQueryBuilder
							->andWhere('ApiBundle:ItemTranslation' . $class . 'Entity.table = :' . $class . 'Table')
							->andWhere('ApiBundle:' . $class . 'Entity.id = ApiBundle:ItemTranslation' . $class . 'Entity.tableId')
							->andWhere('ApiBundle:ItemTranslation' . $class . 'Entity.languageId = :languageId')
							->andWhere('ApiBundle:ItemTranslation' . $class . 'Entity.countryId = :countryId');

			$queryBuilder->andWhere($queryBuilder->expr()->exists($subQuery->getDQL()));
		}

		return $queryBuilder;
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

	// <PARAMETERS>
	private function createParameter(string $key, string $value) : void {
		$this->parameters[$key] = $value;
	}

	private function addParameters(QueryBuilder $queryBuilder) : QueryBuilder {
		foreach ($this->parameters as $key => $value) {
			$queryBuilder->setParameter($key, $value);
		}

		return $queryBuilder;
	}
	// </PARAMETERS>
}
