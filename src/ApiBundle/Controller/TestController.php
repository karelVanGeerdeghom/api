<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\Meta\Convert;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test
// php bin/console doctrine:mapping:convert annotation ./src

class TestController extends Controller
{
	use Convert;

	public function testAction() {
		$filters = $_GET;

		$repository = $this->getDoctrine()->getRepository('ApiBundle:ProductEntity');
		$items = $repository->findByFilters($filters);
return $items;
		$products = $this->convertAll(ucfirst('product'), $items['product']);

		return $products;
	}
}
