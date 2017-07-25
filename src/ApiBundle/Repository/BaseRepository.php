<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

class BaseRepository extends EntityRepository
{
	protected $appId = null;
	protected $locale = null;

	protected $filters = [];

	public function findById(string $id) : array {
		$queryBuilder = $this->createQueryBuilder('ApiBundle:' . $this->class . 'Entity');
		$queryBuilder = $this->addRelations($queryBuilder);

		$query = $queryBuilder
					->andWhere('ApiBundle:' . $this->class . 'Entity.id = :id')
					->setParameter('id', $id)
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
		$queryBuilder = $this->addRelations($queryBuilder);
		$queryBuilder = $this->addFilters($queryBuilder);

		$query = $queryBuilder
					->getQuery();

		$results = $query->getResult(Query::HYDRATE_ARRAY);

		return $this->convertAll($results);
	}

	public function getMeta() : array {
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

		foreach ($item->getRelations() as $relation => $class) {
			$queryBuilder = $queryBuilder
								->addSelect('ApiBundle:' . $class . 'Entity')
								->leftJoin('ApiBundle:' . $this->class . 'Entity.' . $relation, 'ApiBundle:' . $class . 'Entity');
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
			if (array_key_exists(substr($key, 0, -1), $relations)) {
				$this->createFilter($key, $value, $relations[substr($key, 0, -1)]);
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

	private function convertRelations(array &$data) {
		$item = $this->getClass();

		foreach ($item->getRelations() as $relation => $class) {
			if (array_key_exists($relation, $data)) {
				if (!array_key_exists($relation . 's', $data)) {
					$data[$relation . 's'] = [];
				}

				foreach ($data[$relation] as $relationData) {
					$className = 'ApiBundle\\EntityMap\\' . $class;
					$relationItem = new $className;
					$relationItem->set($relationData);

					array_push($data[$relation . 's'], $relationItem->export());
				}

				unset($data[$relation]);
			}
		}
	}

	private function camelCaseToUnderscore(array $data) : array {
		$result = [];

		foreach ($data as $key => $value) {
			if (is_array($value)) {
				$result[$key] = $this->camelCaseToUnderscore($value);
			} else {
				switch ($key) {
					case 'madeWith100percentPurecocoaButter':
						$result['made_with_100percent_purecocoa_butter'] = $value;
					break;
					case 'utzMassBalanceFull100percent':
						$result['utz_mass_balance_full_100percent'] = $value;
					break;
					case 'brandId':
						$result['Brand_id'] = $value;
					break;
					case 'gpcInfoTid':
						$result['GPC_info_tid'] = $value;
					break;
					case 'sapTid':
						$result['SAP_tid'] = $value;
					break;
					case 'sap2Tid':
						$result['SAP2_tid'] = $value;
					break;
					case 'sapCode':
						$result['SAP_code'] = $value;
					break;
					default:
						$result[strtolower(preg_replace('/[A-Z]/', '_\\0', lcfirst($key)))] = $value;
					break;
				}				
			}
		}

		return $result;
	}

	private function underscoreToCamelCase(string $string) : string {
		return lcfirst(preg_replace_callback('/(^|_|\.)+(.)/', function ($match) {
			return ('.' === $match[1] ? '_' : '').strtoupper($match[2]);
		}, $string));
	}
}
