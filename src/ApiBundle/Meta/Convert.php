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
		$item = $this->getClass($class);

		$subItemData = $this->extractSubItemData($item, $data);

		$data = $this->camelCaseToUnderscore($data);
		$data = $this->nullify($data);

		$item->set($data);
	//	$item->setLabels($this->getLabels($item->getTable()));
		$export = $item->export();
	//	$export = [];

		foreach ($subItemData as $subClass => $subItems) {
			$skip = $item->getSkipTo($subClass);

			if ($skip) {
				$skipItems = [];

				foreach ($subItems as $subItem) {
					array_push($skipItems, $subItem[$skip]);
				}

				$skipClass = $item->getSkipClass($subClass);

				$export[$item->getRelationKey($subClass)] = $this->convertAll($skipClass, $skipItems);
				unset($export[$subClass . 's']);
			} else {
				$export[$item->getRelationKey($subClass)] = $this->convertAll($item->getRelationClass($subClass), $subItems);
			}
		}

		return $export;
	}

	protected function getClass($class) {
		$class = 'ApiBundle\\EntityMap\\' . $class;

		return new $class();
	}

	protected function extractSubItemData($item, array &$data) : array {
		$subItems = [];

		foreach ($data as $key => $value) {
			if (is_array($value) && count($value) > 0) {
				if (is_array(array_values($value)[0])) {
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
