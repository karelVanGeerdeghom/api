<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\Meta\Convert;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test

class TestController extends Controller
{
	use Convert;

	public function testAction() {
		$repository = $this->getDoctrine()->getRepository('ApiBundle:ProductEntity');
		$items = $repository->findByIds([9887]);

		return $this->convertAll(ucfirst('product'), $items['product']);
	}
}
