<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/GetProductDetails

class GetProductDetailsController extends Controller
{
	public function getAction() {
		$answer = [];

		$ids = [9887];
		$appId = 5;

		$repository = $this->getDoctrine()->getRepository('ApiBundle:ProductEntity');
		$repository->setAppId($appId);
		$labels = $repository->getLabels($repository->getTable());

		$products = $repository->findByIds($ids);
		foreach ($products as $id => $product) {
			$product->setLabels($labels);
			array_push($answer, $product->export());
		}

		return $answer;
	}
}
