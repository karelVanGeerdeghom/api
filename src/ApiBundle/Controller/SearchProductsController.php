<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/SearchProducts

class SearchProductsController extends Controller {
	public function getAllAction() {
		$answer = [];

		$filters = $_GET;
		if (count($filters) === 0) {
			$filters = [
				'Brand_id' => 18
			];
		}

		$repository = $this->getDoctrine()->getRepository('ApiBundle:ProductEntity');
		$products = $repository->findByFilters($filters);

		return array_keys($products);
	}
}
