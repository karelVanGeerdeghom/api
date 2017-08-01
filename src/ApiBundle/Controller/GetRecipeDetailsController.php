<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\Meta\Convert;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/GetProductDetails

class GetRecipeDetailsController extends Controller
{
	use Convert;

	public function getAction() {
		$entityName = 'Recipe';

		$ids = [1685];
	//	$ids = [555];
		$entities = $this->getDoctrine()->getRepository('ApiBundle:' . $entityName . 'Entity')->findByIds($ids);

		return $this->convertAll($entityName, $entities[strtolower($entityName)]);
	}
}
