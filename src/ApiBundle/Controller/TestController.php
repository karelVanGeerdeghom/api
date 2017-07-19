<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\Controller\BaseController;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test

class TestController extends BaseController {
	public function testAction() {
		$answer = [];

		$appId = 17;
		$brandId = 18;

		$repository = $this->getDoctrine()->getRepository('ApiBundle:ProductEntity');
		$repository->setAppId($appId);
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

		$products = $repository->findByBrand($brandId);
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
						case 'enum_value':
							if (!array_key_exists('options', $answer[$key])) {
								$answer[$key]['options'] = [];
							}

							if (!array_key_exists($value, $answer[$key]['options'])) {
								$answer[$key]['options'][$value] = $this->getValueLabel($key, $value, $valueTranslations, $valueLabels);

							}
						break;
						case 'enum_relation': {
							if (!array_key_exists('options', $answer[$key])) {
								$answer[$key]['options'] = [];
							}

							// foreach ($value as $relation) {
							// 	if (!array_key_exists($relation['id'], $answer[$key]['options'])) {
							// 		$answer[$key]['options'][$relation['id']] = $relation['title'];
							// 	}
							// }

							print($key . ' => ' . json_encode($value) . '<br>');
						}
 					}
				}
			}
		}

		die();

		return $answer;
	}
}
