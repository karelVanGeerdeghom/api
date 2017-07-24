<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\Controller\BaseController;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test

// http://localhost:8888/productdb-api-v3/web/app_dev.php/test?Brand_id=18&fluidity[]=2&fluidity[]=5&roasted[min]=2&taste_coffee=true&cocoa_fatfree_cocoa[min]=20

class TestController extends BaseController {
	public function testAction() {
		$answer = [];

		$repository = $this->getDoctrine()->getRepository('ApiBundle:ProductEntity');
		$meta = $repository->getMeta();
		$products = $repository->findByFilters($_GET);

		foreach ($products as $id => $product) {
			$product->setMeta($meta);
			$answer[$id] = $product->export();
		}

		return $answer;
	}
}
