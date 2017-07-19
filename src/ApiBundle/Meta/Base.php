<?php
namespace ApiBundle\Meta;

use ApiBundle\Meta\Attribute;

class Base {
	protected $table = null;
	protected $meta = null;
	protected $attributes = [];
	protected $relations = [];

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

	public function getTable() : string {
		if ($this->table) {
			return $this->table;
		}
		
		return (new \ReflectionClass($this))->getShortName();
	}

	public function getRelations() : array {
		return $this->relations;
	}

	public function getFilterTypes() : array {
		$filterTypes = [];

		foreach ($this->attributes as $attribute => $properties) {
			$filterType = $this->$attribute->getFilterType();

			if ($filterType && !in_array($filterType, $filterTypes)) {
				array_push($filterTypes, $filterType);
			}
		}

		return $filterTypes;
	}

	public function getByFilterType(string $filterType) : array {
		$results = [];

		foreach ($this->attributes as $attribute => $properties) {
			if ($this->$attribute->getFilterType() === $filterType) {
				$filterValue = $this->$attribute->get();
				if ($filterValue) {
					if (!is_bool($filterValue)) {
						$filterValue = (string)$filterValue;
					}
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

			$reference = &$results;
			if ($attributeData['group']) {
				if (!array_key_exists($attributeData['group'], $results)) {
					$results[$attributeData['group']] = [];
				}

				$reference = &$results[$attributeData['group']];
			}

			$reference = array_merge($reference, [$attributeData['key'] => $attributeData['value']]);
		}

		return $results;
	}
}
