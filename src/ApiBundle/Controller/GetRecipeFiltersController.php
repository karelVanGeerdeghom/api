<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\Meta\Filter;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/GetRecipeFilters

class GetRecipeFiltersController extends Controller
{
	use Filter;

	public function getAction() {
		$answer = [];
		$filters = $_GET;
		if (count($filters) === 0) {
			$filters = [
				'Brand_id' => 5
			];
		}

		$entityName = 'Recipe';

		$entities = $this->getDoctrine()->getRepository('ApiBundle:' . $entityName . 'Entity')->findByFilters($filters);
		foreach ($entities[strtolower($entityName)] as $entityData) {
			$this->getFilters($answer, $entityData, $entityName);
		}

		return $answer;
	}
}
