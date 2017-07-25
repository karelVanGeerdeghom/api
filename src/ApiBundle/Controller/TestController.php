<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\EntityMap\Author;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test

class TestController extends Controller
{
	public function testAction() {
		$repository = $this->getDoctrine()->getRepository('ApiBundle:ProductEntity');
		$products = $repository->findByBrand(18);

		return $products;
	}
}
