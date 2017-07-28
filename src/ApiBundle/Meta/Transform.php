<?php

namespace ApiBundle\Meta;

trait Transform
{
	protected function nullify($data) {
		if (is_array($data)) {
			$result = [];

			foreach ($data as $key => $value) {
				if (!is_array($value)) {
					$result[$key] = $value === '-1' || $value === -1 ? null : $value;
				}
			}

			return $result;
		}

		return $data === '-1' || $data === -1 ? null : $data;
	}

	protected function camelCaseToUnderscore($data) {
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

		if (is_array($data)) {
			$result = [];
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

		if (array_key_exists($data, $camelCaseToUnderscores)) {
			return $camelCaseToUnderscores[$data];
		}
			
		return strtolower(preg_replace('/[A-Z]/', '_\\0', lcfirst($data)));
	}

	protected function underscoreToCamelCase(string $string) : string {
		return lcfirst(preg_replace_callback('/(^|_|\.)+(.)/', function ($match) {
			return ('.' === $match[1] ? '_' : '').strtoupper($match[2]);
		}, $string));
	}

	protected function toIdArray($data) {
		$ids = [];

		foreach ($data as $row) {
			array_push($ids, $row['id']);
		}

		return $ids;
	}
}
