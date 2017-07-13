<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\Factory\ProductFactory;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test

class TestController extends Controller
{
	public function testAction() {
		$answer = [];

		$factory = new ProductFactory();
		$product = $factory->getById(9887);

		return $product;
	}
}
