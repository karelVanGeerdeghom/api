<?php

namespace ApiBundle\Meta;

use ApiBundle\Meta\Attribute;

class Base
{
	const TRANSLATION = [
		'translation' => true,
		'labels' => ['ColumnTranslation']
	];

	protected $table = null;
	protected $labels = null;
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

		return $this;
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

	public function getTable() : string {
		if ($this->table) {
			return $this->table;
		}

		return (new \ReflectionClass($this))->getShortName();
	}

	public function setLabels($labels = null) {
		$this->labels = $labels;
	}

	public function getLabels() : ?array {
		return $this->labels;
	}

	public function getRelations() : array {
		$relations = [];

		foreach ($this->attributes as $attribute => $properties) {
			if ($this->$attribute->getRelation()) {
				$relations[$attribute] = [
					'class' => $properties['class'],
					'key' => $properties['key']
				];
			}
		}

		return $relations;
	}

	public function getFilterRelations() : array {
		$relations = [];

		foreach ($this->attributes as $attribute => $properties) {
			if ($this->$attribute->getFilterRelation()) {
				$relations[$attribute] = [
					'class' => $properties['class'],
					'key' => $properties['key']
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
		return $this->$attribute->getValue($this->labels);
	}

	private function exportMultiple(array $attributes) : array {
		$results = [];

		foreach ($attributes as $attribute) {
			$reference = &$results;

			if ($this->$attribute->getGroup()) {
				if (!array_key_exists($this->$attribute->getGroup(), $results)) {
					$results[$this->$attribute->getGroup()] = [];
				}

				$reference = &$results[$this->$attribute->getGroup()];
			}

			$reference = array_merge($reference, [$this->$attribute->getKey() => $this->$attribute->getValue($this->labels)]);
		}

		return $results;
	}
}
