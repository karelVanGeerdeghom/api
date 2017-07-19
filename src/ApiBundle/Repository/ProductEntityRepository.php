<?php

namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query;

use ApiBundle\Type\Product;

class ProductEntityRepository extends EntityRepository {
	protected $meta = true;

	public function findById($id) : ?Product {
		$result = $this->getEntityManager()
						->createQuery('SELECT r FROM ApiBundle:ProductEntity r WHERE r.id = :id')
						->setParameter('id', $id)
						->getOneOrNullResult(Query::HYDRATE_ARRAY);

		if ($result) {
			return $this->convertOne($result);
		}

		return null;		
	}

	public function findByBrand($brandId) : array {
		$result = $this->getEntityManager()
						->createQuery('SELECT r FROM ApiBundle:ProductEntity r WHERE r.brandId = :brandId')
						->setParameter('brandId', $brandId)
						->getResult(Query::HYDRATE_ARRAY);

		return $this->convertAll($result);
	}

	public function getMeta() : array {
		$columnTranslation = $this->getEntityManager()->getRepository('ApiBundle:ColumntranslationEntity')->findByAppTable(5, 'recipe');
		$valueTranslation = $this->getEntityManager()->getRepository('ApiBundle:ValuetranslationEntity')->findByAppTable(17, 'recipe');
		$fieldDescription = $this->getEntityManager()->getRepository('ApiBundle:FielddescriptionEntity')->findByTable('recipe');

		return [
			'ColumnTranslation' => $columnTranslation,
			'ValueTranslation' => $valueTranslation,
			'FieldDescription' => $fieldDescription
		];
	}

	private function convertOne(array $data) : Product {
		$data = $this->camelCaseToUnderscore($data);

		$product = new Product();
		$product->set($data);

		return $product;
	}

	private function convertAll(array $results) : array {
		$products = [];

		foreach ($results as $data) {
			$products[$data['id']] = $this->convertOne($data);
			// array_push($products, $this->convertOne($data));
		}

		return $products;
	}

	private function camelCaseToUnderscore(array $array) : array {
		$result = [];

		foreach ($array as $key => $value) {
			switch ($key) {
				case 'madeWith100percentPurecocoaButter':
					$result['made_with_100percent_purecocoa_butter'] = $value;
					break;
				case 'utzMassBalanceFull100percent':
					$result['utz_mass_balance_full_100percent'] = $value;
					break;
				default:
					$result[strtolower(preg_replace('/[A-Z]/', '_\\0', lcfirst($key)))] = $value;
					break;
			}
		}

		return $result;
	}
}