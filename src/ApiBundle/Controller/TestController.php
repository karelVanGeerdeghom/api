<?php

namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\Controller\BaseController;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test

// http://localhost:8888/productdb-api-v3/web/app_dev.php/test?Brand_id=18&fluidity[]=2&fluidity[]=5&roasted[min]=2&taste_coffee=true&cocoa_fatfree_cocoa[min]=20

class TestController extends BaseController {
	public function testAction() {
		$answer = [];
		$id = 9887;

//		fluidity[]=2&fluidity[]=5&roasted[min]=2

		$filters = [
			[
				'where' => 'ApiBundle:ProductEntity.brandId = :brandId',
				'parameter' => 'brandId',
				'value' => 18
			],
			[
				'where' => 'ApiBundle:ProductEntity.cocoaFatfreeCocoa < :cocoaFatfreeCocoa',
				'parameter' => 'cocoaFatfreeCocoa',
				'value' => 20
			],
			[
				'where' => 'ApiBundle:ProductEntity.chocolateType IN (:chocolateType)',
				'parameter' => 'chocolateType',
				'value' => ['Dark', 'Milk']
			],
			[
				'where' => 'ApiBundle:ProductEntity.chocolateType = :chocolateType',
				'parameter' => 'chocolateType',
				'value' => 'Milk'
			],
		];

		$repository = $this->getDoctrine()->getRepository('ApiBundle:ProductEntity');
		$meta = $repository->getMeta();
		$products = $repository->findByFilters($_GET);

		foreach ($products as $id => $product) {
			$product->setMeta($meta);
			array_push($answer, $product->export());
		}

		return $answer;
	}
}
