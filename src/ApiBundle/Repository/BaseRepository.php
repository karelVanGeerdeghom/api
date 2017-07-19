<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BaseRepository extends EntityRepository {
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

	public function setAppId($appId) {
		$this->appId = $appId;
	}

	public function setLocale($locale) {
		$this->locale = $locale;
	}

	protected function convertOne(array $data) {
		$data = $this->camelCaseToUnderscore($data);
		$data = $this->convertRelations($data);

		$item = new $this->class();
		$item->set($data);

		return $item;
	}

	protected function convertAll(array $results) {
		$items = [];

		foreach ($results as $data) {
			$items[$data['id']] = $this->convertOne($data);
		}

		return $items;
	}

	protected function convertRelations(array $data) {
		$item = new $this->class();

		foreach ($item->getRelations() as $relation => $class) {
			if (array_key_exists($relation, $data)) {
				if (!array_key_exists($relation . 's', $data)) {
					$data[$relation . 's'] = [];
				}

				foreach ($data[$relation] as $relationData) {
					$relationItem = new $class;
					$relationItem->set($relationData);

					array_push($data[$relation . 's'], $relationItem->export());
				}

				unset($data[$relation]);
			}
		}

		return $data;
	}

	protected function camelCaseToUnderscore(array $array) : array {
		$result = [];

		foreach ($array as $key => $value) {
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
					default:
						$result[strtolower(preg_replace('/[A-Z]/', '_\\0', lcfirst($key)))] = $value;
						break;
				}				
			}
		}

		return $result;
	}
}