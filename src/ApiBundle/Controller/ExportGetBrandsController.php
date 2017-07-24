<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\EntityMap\Brand;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/ExportGetBrands

class ExportGetBrandsController extends Controller
{
	public function getAction() {
		$all = [];

		$connectionFactory = $this->get('doctrine.dbal.connection_factory');
		$connection = $connectionFactory->createConnection(
			['pdo' => new \PDO('mysql:host=localhost;dbname=bcproductdb_st', 'root', 'root')]
		);

		$result = $connection->fetchAll('SELECT * FROM Brand');
		foreach ($result as $row) {
			$brand = new Brand();
			$brand->set($row);
			array_push($all, $brand->get());
		}

		return $all;
	}
}
