<?php
namespace ApiBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use ApiBundle\Entity\Product;

// http://localhost:8888/productdb-api-v3/web/app_dev.php/Test

class TestController extends Controller
{
	public function testAction() {
		$answer = [];
		$id = 9887;

		$connectionFactory = $this->get('doctrine.dbal.connection_factory');
		$connection = $connectionFactory->createConnection(
			['pdo' => new \PDO('mysql:host=localhost;dbname=bcproductdb_st', 'root', 'root')]
		);

		$columnTranslation = [];
		$result = $connection->fetchAll('SELECT * FROM Columntranslation ct WHERE ct.App_id = 5 AND ct.table = "recipe"');
		foreach ($result as $row) {
			$columnTranslation[$row['column']] = $row['label_tid'];
		}

		$valueTranslation = [];
		$result = $connection->fetchAll('SELECT * FROM Valuetranslation vt WHERE vt.App_id = 17 AND vt.table = "recipe"');
		foreach ($result as $row) {
			if (!array_key_exists($row['column'], $valueTranslation)) {
				$valueTranslation[$row['column']] = [];
			}
			$valueTranslation[$row['column']][$row['value']] = $row['label_tid'];
		}

		$fieldDescription = [];
		$result = $connection->fetchAll('SELECT * FROM Fielddescription fd WHERE fd.Tablename = "Recipe"');
		foreach ($result as $row) {
			$fieldDescription[$row['Fieldname']] = $row['description_tid'];
		}

		$meta = [
			'ColumnTranslation' => $columnTranslation,
			'ValueTranslation' => $valueTranslation,
			'FieldDescription' => $fieldDescription
		];

		$result = $connection->fetchAll('SELECT * FROM Recipe WHERE id = ' . $id);
		$set = $result[0];

		$product = new Product();
	 	$product->setMeta($meta);
		$product->set($set);
		$answer = $product->export();

		foreach ($product->getRelations() as $relation) {
			$answer[strtolower($relation) . 's'] = [];

			$className = 'ApiBundle\\Entity\\' . $relation;
			$class = new $className();
			$relationTable = $product->getTable() . $class->getTable();

			$query = 'SELECT c.* FROM ' . $relationTable . ' r, ' . $class->getTable() . ' c WHERE r.' . $product->getTable() . '_id = ' . $id . ' AND c.id = r.' . $class->getTable() . '_id';
			$result = $connection->fetchAll($query);
			foreach ($result as $row) {
				$class->set($row);
				array_push($answer[strtolower($relation) . 's'], $class->export());
			}
		}

		return $answer;
	}

/*
	public function testAction() {
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
			'cacao_percentage' => '25.7',
			'bitter' => '3',
			'taste_almond' => true
		];

		$product = new Product();
		$product->setMeta($meta);
		$product->set($set);

		return $product->export();
	}
*/
}
