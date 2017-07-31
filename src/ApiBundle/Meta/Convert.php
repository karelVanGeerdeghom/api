<?php

namespace ApiBundle\Meta;

use ApiBundle\Meta\Transform;

trait Convert
{
	use Transform;

	protected function convertAll(string $class, array $items) : array {
		$all = [];

		foreach ($items as $itemData) {
			array_push($all, $this->convertOne($class, $itemData));
		}

		return $all;
	}

	protected function convertOne(string $class, array $data) {
		$subItemData = $this->extractSubItemData($data);

		$data = $this->camelCaseToUnderscore($data);
		$data = $this->nullify($data);

		$item = $this->getClass($class)->set($data);
	//	$item->setLabels($this->getLabels($item->getTable()));
		$export = $item->export();

		foreach ($subItemData as $subClass => $subItems) {
			$export[$item->getRelationKey($subClass)] = $this->convertAll(ucfirst($subClass), $subItems);
		}

		return $export;
	}

	protected function getClass($class) {
		$class = 'ApiBundle\\EntityMap\\' . $class;

		return new $class();
	}

	protected function extractSubItemData(array &$data) : array {
		$subItems = [];

		foreach ($data as $key => $value) {


			if (is_array($value) && count($value) > 0) {
				// if ($key === 'direction') {
				// 	print count($value) . '<br>';
				// 	print count($value, COUNT_RECURSIVE) . '<br>';
				// 	print json_encode($value) . '<br><br><br>';
				// }

				if (is_array(array_values($value)[0])) {
				// if (count($value) !== count($value, COUNT_RECURSIVE)) {
					$subItems[$key] = $value;
				} else {
					$subItems[$key] = [$value];
				}
				unset($data[$key]);
			}
		}

		return $subItems;
	}
}
