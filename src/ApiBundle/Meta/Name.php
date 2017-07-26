<?php

namespace ApiBundle\Meta;

trait Name
{
	protected function camelCaseToUnderscore(array $data) : array {
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
					case 'countryId':
						$result['Country_id'] = $value;
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

	protected function underscoreToCamelCase(string $string) : string {
		return lcfirst(preg_replace_callback('/(^|_|\.)+(.)/', function ($match) {
			return ('.' === $match[1] ? '_' : '').strtoupper($match[2]);
		}, $string));
	}
}
