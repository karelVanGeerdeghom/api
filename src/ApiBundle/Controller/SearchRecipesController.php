<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/SearchProducts

class SearchRecipesController extends Controller
{
	public function getAction() {
		$filters = $_GET;
		if (count($filters) === 0) {
			$filters = [
				'Brand_id' => 5
			];
		}

		$entityName = 'Recipe';

		return $this->getDoctrine()->getRepository('ApiBundle:' . $entityName . 'Entity')->findIdsByFilters($filters);
	}
}