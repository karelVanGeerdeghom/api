<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\EntityMap\Product;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test

class TestController extends Controller
{
	public function testAction() {
		$answer = [];

		$filters = $_GET;
		if (count($filters) === 0) {
			$filters = [
				'Brand_id' => 1
			];
		}

		$repository = $this->getDoctrine()->getRepository('ApiBundle:ProductEntity');

		$products = $repository->findByFilters($filters);
return $products;
		foreach ($products as $id => $product) {
			array_push($answer, $product->export());
		}


		return $answer;
	}
}
