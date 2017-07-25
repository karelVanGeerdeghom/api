<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test

class TestController extends Controller
{
	public function testAction() {
		$answer = [];

		$repository = $this->getDoctrine()->getRepository('ApiBundle:ProductEntity');

		$products = $repository->findById(9887);
		foreach ($products as $id => $product) {
			$product->setMeta($repository->getMeta());
			array_push($answer, $product->export());
		}

		return $answer;
	}
}
