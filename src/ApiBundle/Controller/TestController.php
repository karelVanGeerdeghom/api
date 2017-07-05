<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\Entity\Product;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test

class TestController extends Controller
{
	public function testAction() {
		$test = [];

		$product = new Product();

		return $product->get();
	}
}
