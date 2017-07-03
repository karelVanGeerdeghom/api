<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use ApiBundle\Entity\Brand;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/ExportGetBrands

class ExportGetBrandsController extends Controller
{
	public function getAllAction() {
		$all = [];

		$brand = new Brand();
		$brand->set('id', 1);
		$brand->set('url', 'http://localhost:8888/productdb-api-v3/web/app_dev.php/ExportGetBrands');
		$brand->set('title_tid', 'Brand 1');

		array_push($all, $brand->get());

		$brand = new Brand();
		$brand->set('id', 2);
		$brand->set('url', 'http://localhost:8888/productdb-api-v3/web/app_dev.php/ExportGetBrands');
		$brand->set('title_tid', 'Brand 2');

		array_push($all, $brand->get());

		return $all;
	}
}
