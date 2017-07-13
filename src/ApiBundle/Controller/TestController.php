<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test

class TestController extends Controller
{
	public function testAction() {
		$answer = [];

		$product = $this->getDoctrine()->getRepository('ApiBundle:Product')->findById(9887);

		return $product;
	}
}
