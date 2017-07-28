<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\Meta\Convert;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/GetAuthorDetails

class GetAuthorDetailsController extends Controller
{
	use Convert;

	public function getAction() {
		$entityName = 'Author';

		$ids = [1];
		$entities = $this->getDoctrine()->getRepository('ApiBundle:' . $entityName . 'Entity')->findByIds($ids);
		return $this->convertAll($entityName, $entities[strtolower($entityName)]);
	}
}
