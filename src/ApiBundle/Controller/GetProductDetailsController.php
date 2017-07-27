<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\Meta\Convert;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/GetProductDetails

class GetProductDetailsController extends Controller
{
	use Convert;

	public function getAction() {
		$ids = [9887];

		$repository = $this->getDoctrine()->getRepository('ApiBundle:ProductEntity');
		$items = $repository->findByIds($ids);

		$products = $this->convertAll(ucfirst('product'), $items['product']);

		return $products;
	}
}
