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
		$item = new $this->class();
		$item->set($this->camelCaseToUnderscore($data));

		return $item;
	}

	protected function convertAll(array $results) {
		$items = [];

		foreach ($results as $data) {
			$items[$data['id']] = $this->convertOne($data);
		}

		return $items;
	}

	protected function camelCaseToUnderscore(array $array) : array {
		$result = [];

		foreach ($array as $key => $value) {
			switch ($key) {
				case 'madeWith100percentPurecocoaButter':
					$result['made_with_100percent_purecocoa_butter'] = $value;
					break;
				case 'utzMassBalanceFull100percent':
					$result['utz_mass_balance_full_100percent'] = $value;
					break;
				default:
					$result[strtolower(preg_replace('/[A-Z]/', '_\\0', lcfirst($key)))] = $value;
					break;
			}
		}

		return $result;
	}
}