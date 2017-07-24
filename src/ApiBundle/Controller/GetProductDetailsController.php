<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/GetProductDetails

class GetProductDetailsController extends Controller
{
	public function getAction() {
		$answer = [];

		$id = 9887;

		$repository = $this->getDoctrine()->getRepository('ApiBundle:ProductEntity');

		$products = $repository->findById($id);
		foreach ($products as $id => $product) {
			$product->setMeta($repository->getMeta());
			array_push($answer, $product->export());
		}

		return $answer;
	}
}
