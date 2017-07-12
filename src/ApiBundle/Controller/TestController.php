<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\Entity\Product;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test

class TestController extends Controller
{
	public function testAction() {
		$product = new Product();

		$columnTranslation = [
			'cacao_percentage' => 11111,
			'caramel' => 22222,
			'chocolate_type' => 33333,
			'bitter' => 00000
		];
		$valueTranslation = [
			'caramel' => 44444,
			'smooth' => 55555
		];
		$fieldDescription = [
			'bitter' => 66666,
			'cocoa_taste' => 77777
		];

		$meta = [
			'ColumnTranslation' => $columnTranslation,
			'ValueTranslation' => $valueTranslation,
			'FieldDescription' => $fieldDescription
		];

		$set = [
			'id' => 1,
			'content_tid' => 88888,
			'description_tid' => 99999,
			'chocolate_type' => 'caramel',
			'texture' => 'smooth',
			'cacao_percentage' => 25.7,
			'bitter' => 3
		];

		$product->setMeta($meta);
		$product->set($set);

		return $product->get();
	}
}
