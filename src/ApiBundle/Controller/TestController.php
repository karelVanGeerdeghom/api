<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\EntityMap\Product;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test

class TestController extends Controller
{
	public function testAction() {
		$answer = [];

		// $product = new Product();
		// return $product->getRelations();

		$repository = $this->getDoctrine()->getRepository('ApiBundle:ProductEntity');

		$products = $repository->findById(9887);

		foreach ($products as $id => $product) {
			$product->setMeta($repository->getMeta());
			array_push($answer, $product->export());
		}

		return $answer;
	}
}
