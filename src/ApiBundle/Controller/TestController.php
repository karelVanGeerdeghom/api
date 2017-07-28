<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\Meta\Filter;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test?Brand_id=1&application=122&color=1&&kosher=true
// php bin/console doctrine:mapping:convert annotation ./src

class TestController extends Controller
{
	use Filter;

	public function testAction() {
		$answer = [];
		$filters = $_GET;
		if (count($filters) === 0) {
			$filters = [
				'Brand_id' => 16
			];
		}

		$entityName = 'Product';

		$entityClass = 'ApiBundle\\EntityMap\\' . $entityName;
		$entityMap = new $entityClass();
		$entityFilterData = [];
		foreach ($entityMap->getFilterTypes() as $filterType) {
			$entityFilterData[$filterType] = $entityMap->getFiltersByType($filterType);
		}

		$entities = $this->getDoctrine()->getRepository('ApiBundle:' . $entityName . 'Entity')->findByFilters($filters);

		foreach ($entities[strtolower($entityName)] as $entityData) {
			$this->getFilters($answer, $entityData, $entityMap, $entityFilterData);
		}

		return $answer;
	}
}
