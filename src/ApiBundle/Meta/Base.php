<?php

namespace ApiBundle\Meta;

use ApiBundle\Meta\Attribute;

class Base
{
	const TRANSLATION = [
		'type' => 'translation',
		'meta' => ['ColumnTranslation']
	];

	protected $table = null;
	protected $meta = null;
	protected $attributes = [];

	function __construct() {
		foreach ($this->attributes as $attribute => $properties) {
			$this->$attribute = new Attribute($attribute, $properties);
		}
	}

	public function set() {
		$arguments = func_get_args();

		if (count($arguments) === 2) {
			$this->setSingle($arguments[0], $arguments[1]);
		}

		if (count($arguments) === 1) {
			$this->setMultiple($arguments[0]);
		}
	}

	public function get($data = null) {
		if (is_string($data) && array_key_exists($data, $this->attributes)) {
			return $this->getSingle($data);
		}

		if (is_array($data) && count(array_intersect(array_keys($this->attributes), $data)) > 0) {
			return $this->getMultiple(array_intersect(array_keys($this->attributes), $data));
		}

		if ($data === null) {
			return $this->getMultiple(array_keys($this->attributes));
		}
	}

	public function export($data = null) : array {
		if (is_string($data) && array_key_exists($data, $this->attributes)) {
			return $this->exportSingle($data);
		}

		if (is_array($data) && count(array_intersect(array_keys($this->attributes), $data)) > 0) {
			return $this->exportMultiple(array_intersect(array_keys($this->attributes), $data));
		}

		if ($data === null) {
			return $this->exportMultiple(array_keys($this->attributes));
		}
	}

	public function setMeta($meta = null) {
		$this->meta = $meta;
	}

	public function getMeta() : ?array {
		return $this->meta;
	}

	public function getRelations() : array {
		$relations = [];

		foreach ($this->attributes as $attribute => $properties) {
			if ($this->$attribute->getRelation()) {
				$relations[$attribute] = [
					'class' => $this->$attribute->getClass(),
					'label' => $this->$attribute->getLabel()
				];
			}
		}

		return $relations;
	}

	public function getFilters() : array {
		$filters = [];

		foreach ($this->attributes as $attribute => $properties) {
			$filter = $this->$attribute->getFilter();

			if ($filter && !in_array($filter, $filters)) {
				array_push($filters, $filter);
			}
		}

		return $filters;
	}

	public function getByFilter(string $filter) : array {
		$results = [];

		foreach ($this->attributes as $attribute => $properties) {
			if ($this->$attribute->getFilter() === $filter) {
				$filterValue = $this->$attribute->get();
				if ($filterValue) {
					$results[$attribute] = $filterValue;
				}
			}
		}

		return $results;
	}

	private function setSingle(string $attribute, $value) {
		if (array_key_exists($attribute, $this->attributes)) {
			$this->$attribute->set($value);
		}
	}

	private function setMultiple(array $data) {
		foreach ($data as $attribute => $value) {
			$this->setSingle($attribute, $value);
		}
	}

	private function getSingle(string $attribute) {
		return $this->$attribute->get();
	}

	private function getMultiple(array $attributes) : array {
		$results = [];
		foreach ($attributes as $attribute) {
			$results[$attribute] = $this->$attribute->get();
		}

		return $results;
	}

	private function exportSingle(string $attribute) : array {
		return $this->$attribute->export($this->meta);
	}

	private function exportMultiple(array $attributes) : array {
		$results = [];
		foreach ($attributes as $attribute) {
			$attributeData = $this->$attribute->export($this->meta);
			$key = $attributeData['key'];

			$reference = &$results;
			if ($attributeData['group']) {
				if (!array_key_exists($attributeData['group'], $results)) {
					$results[$attributeData['group']] = [];
				}

				$reference = &$results[$attributeData['group']];
			}

			if ($attributeData['label']) {
				$key = $attributeData['label'];
			}

			$reference = array_merge($reference, [$key => $attributeData['value']]);
		}

		return $results;
	}
}
