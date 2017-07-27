<?php

namespace ApiBundle\Meta;

trait Convert
{
	protected function convertAll(string $class, array $items) : array {
		$all = [];

		foreach ($items as $itemData) {
			array_push($all, $this->convertOne($class, $itemData));
		}

		return $all;
	}

	protected function convertOne(string $class, array $data) {
		$subItemData = $this->extractSubItemData($data);

		$data = $this->camelCaseToUnderscore($data);
		$data = $this->nullifyData($data);

		$item = $this->getClass($class)->set($data);
		// $item->setLabels($this->getLabels($item->getTable()));
		$export = $item->export();

		foreach ($subItemData as $subClass => $subItems) {
			$export[$subClass] = $this->convertAll(ucfirst($subClass), $subItems);
		}

		return $export;
	}

	protected function getLabels(string $table) : array {
		$columnTranslation = $this->getDoctrine()->getRepository('ApiBundle:ColumntranslationEntity')->findByAppTable(5, $table);
		$valueTranslation = $this->getDoctrine()->getRepository('ApiBundle:ValuetranslationEntity')->findByAppTable(5, $table);
		$fieldDescription = $this->getDoctrine()->getRepository('ApiBundle:FielddescriptionEntity')->findByTable($table);

		return [
			'ColumnTranslation' => $columnTranslation,
			'ValueTranslation' => $valueTranslation,
			'FieldDescription' => $fieldDescription
		];
	}

	protected function getClass($class) {
		$class = 'ApiBundle\\EntityMap\\' . $class;

		return new $class();
	}

	protected function extractSubItemData(array &$data) : array {
		$subItems = [];

		foreach ($data as $key => $value) {
			if (is_array($value)) {
				if (count($value) !== count($value, COUNT_RECURSIVE)) {
					$subItems[$key] = $value;
				} else {
					$subItems[$key] = [$value];
				}
				unset($data[$key]);
			}
		}

		return $subItems;
	}

	protected function nullifyData(array $data) {
		$result = [];

		foreach ($data as $key => $value) {
			if (!is_array($value)) {
				$result[$key] = $value === '-1' || $value === -1 ? null : $value;
			}
		}

		return $result;
	}

	protected function camelCaseToUnderscore(array $data) : array {
		$result = [];

		$camelCaseToUnderscores = [
			'madeWith100percentPurecocoaButter'	=> 'made_with_100percent_purecocoa_butter',
			'utzMassBalanceFull100percent'		=> 'utz_mass_balance_full_100percent',
			'brandId'							=> 'Brand_id',
			'countryId'							=> 'Country_id',
			'gpcInfoTid'						=> 'GPC_info_tid',
			'sapTid'							=> 'SAP_tid',
			'sap2Tid'							=> 'SAP2_tid',
			'sapCode'							=> 'SAP_code',
			'oneOneAmountTid'					=> '1_1_amount_tid',
			'oneOneTypeTid'						=> '1_1_type_tid',
			'oneTwoAmountTid'					=> '1_2_amount_tid',
			'oneTwoTypeTid'						=> '1_2_type_tid',
			'twoOneAmountTid'					=> '2_1_amount_tid',
			'twoOneTypeTid'						=> '2_1_type_tid',
			'twoTwoAmountTid'					=> '2_2_amount_tid',
			'twoTwoTypeTid'						=> '2_2_type_tid',
			'threeOneAmountTid'					=> '3_1_amount_tid',
			'threeOneTypeTid'					=> '3_1_type_tid',
			'threeTwoAmountTid'					=> '3_2_amount_tid',
			'threeTwoTypeTid'					=> '3_2_type_tid'
		];

		foreach ($data as $key => $value) {
			if (!is_array($value)) {
				if (array_key_exists($key, $camelCaseToUnderscores)) {
					$result[$camelCaseToUnderscores[$key]] = $value;
				} else {
					$result[strtolower(preg_replace('/[A-Z]/', '_\\0', lcfirst($key)))] = $value;
				}
			}
		}

		return $result;
	}
}
