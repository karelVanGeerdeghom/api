<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\Controller\BaseController;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/GetProductFilters

class GetProductFiltersController extends BaseController {
	public function getAllAction() {
		$answer = [];

		$appId = 17;

		$filters = $_GET;
		if (count($filters) === 0) {
			$filters = [
				'Brand_id' => 5
			];
		}

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

		$products = $repository->findByFilters($filters);
		foreach ($products as $id => $product) {
			foreach ($product->getFilters() as $filter) {
				$values = $product->getByFilter($filter);

				foreach ($values as $key => $value) {
					if (!array_key_exists($key, $answer)) {
						$answer[$key] = [
							'label' => $this->getColumnLabel($key, $columnTranslations),
							'type' => $filter
						];
					}

					switch ($filter) {
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
								$answer[$key]['options']['min'] = (string)$value;
							}
							if ($answer[$key]['options']['max'] === '' || $value > $answer[$key]['options']['max']) {
								$answer[$key]['options']['max'] = (string)$value;
							}
						break;
						case 'enum':
							if (!array_key_exists('options', $answer[$key])) {
								$answer[$key]['options'] = [];
							}

							if (!is_array($value) && !array_key_exists($value, $answer[$key]['options'])) {
								$answer[$key]['options'][$value] = $this->getValueLabel($key, $value, $valueTranslations, $valueLabels);
							}
							if (is_array($value)) {
								foreach ($value as $relation) {
									if (!array_key_exists($relation['id'], $answer[$key]['options'])) {
										$answer[$key]['options'][$relation['id']] = $relation['title'];
									}
								}
							}
						break;
 					}
				}
			}
		}

		return $answer;
	}
}
