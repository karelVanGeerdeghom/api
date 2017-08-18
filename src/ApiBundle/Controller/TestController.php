<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\Meta\Convert;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test
// php bin/console doctrine:mapping:convert annotation ./src
// git remote update origin --prune

class TestController extends Controller
{
	use Convert;

	// public function testAction() {
	// 	$entityName = 'Recipe';
	// 	$ids = [1685];

	// 	$entities = $this->getDoctrine()->getRepository('ApiBundle:' . $entityName . 'Entity')->findByIds($ids);

	// 	return $this->convertAll($entityName, $entities[strtolower($entityName)]);
	// }

	public function testAction() {
		$filters = $_GET;
		if (count($filters) === 0) {
			$filters = [
				'Brand_id' => 18
			];
		}

		$entityName = 'Product';
		$entities = $this->getDoctrine()->getRepository('ApiBundle:' . $entityName . 'Entity')->findByFilters($filters);
return $entities;
		return $this->convertAll($entityName, $entities[strtolower($entityName)]);
	}
}
