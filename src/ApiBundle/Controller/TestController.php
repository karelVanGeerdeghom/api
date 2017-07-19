<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test

class TestController extends Controller {
	public function testAction() : array {
		$answer = [];

		$repository = $this->getDoctrine()->getRepository('ApiBundle:ProductEntity');
		$meta = $repository->getMeta();

		$columnTranslations = $meta['ColumnTranslation'];
		$valueTranslations = $meta['ValueTranslation'];
		$valueLabels = [
			'fluidity' => [
				'1' => 'Very low fluidity',
				'2' => 'Low fluidity',
				'3' => 'Standard fluidity',
				'4' => 'High fluidity',
				'5' => 'Very high fluidity'
			],
			'roast_level' => [
				'1' => 'Unroasted',
				'2' => 'Light Roast',
				'3' => 'Medium Roast',
				'4' => 'Dark Roast'
			],
			'ph' => [
				'natural'			=> '5-6.2 (Natural)',
				'light_alkalized'	=> '6.8-7.5 (Light alkalized)',
				'medium_alkalized'	=> '7.2-7.7 (Medium alkalized)',
				'high_alkalized'	=> '7.6-8.2 (High alkalized)'
			]
		];

		$products = $repository->findByBrand(1);
		foreach ($products as $id => $product) {
			foreach ($product->getFilterTypes() as $filterType) {
				$values = $product->getByFilterType($filterType);

				foreach ($values as $key => $value) {
					if (!array_key_exists($key, $answer)) {
						$answer[$key] = [
							'label' => $this->getColumnLabel($key, $columnTranslations),
							'type' => $filterType
						];
					}

					switch ($filterType) {
						case 'boolean':
							if (!array_key_exists('options', $answer[$key])) {
								$answer[$key]['options'] = 'false';
							}

							$answer[$key]['options'] = 'true';
						break;
						case 'float':
							if (!array_key_exists('options', $answer[$key])) {
								$answer[$key]['options'] = [
									'min' => '',
									'max' => ''
								];
							}

							if ($answer[$key]['options']['min'] === '' || $value < $answer[$key]['options']['min']) {
								$answer[$key]['options']['min'] = $value;
							}
							if ($answer[$key]['options']['max'] === '' || $value > $answer[$key]['options']['max']) {
								$answer[$key]['options']['max'] = $value;
							}
						break;
						case 'enum':
							if (!array_key_exists('options', $answer[$key])) {
								$answer[$key]['options'] = [];
							}

							if (!array_key_exists($value, $answer[$key]['options'])) {
								$answer[$key]['options'][$value] = $this->getValueLabel($key, $value, $valueTranslations, $valueLabels);

							}
						break;
 					}
				}
			}
		}

		return $answer;
	}

	private function getColumnLabel($key, $columnTranslations) {
		if (array_key_exists($key, $columnTranslations)) {
			return 't(' . $columnTranslations[$key] . ')';
		}

		return $key;
	}

	private function getValueLabel($key, $value, $valueTranslations, $valueLabels) {
		if (array_key_exists($key, $valueTranslations)) {
			if (array_key_exists($value, $valueTranslations[$key])) {
				return 't(' . $valueTranslations[$key][$value] . ')';
			}
		}

		if (array_key_exists($key, $valueLabels)) {
			if (array_key_exists($value, $valueLabels[$key])) {
				return $valueLabels[$key][$value];
			}
		}

		return $value;
	}
}
