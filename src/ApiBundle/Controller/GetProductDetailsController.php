<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/GetProductDetails

class GetProductDetailsController extends Controller {
	public function getAllAction() : array {
		$answer = [];
		$id = 10128;

		$repository = $this->getDoctrine()->getRepository('ApiBundle:ProductEntity');

		$product = $repository->findById($id);
		if ($product) {
			$product->setMeta($repository->getMeta());
			$answer = $product->export();
		}

		return $answer;
	}
}
