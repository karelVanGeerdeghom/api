<?php

namespace ApiBundle\Meta;

use ApiBundle\Meta\Attribute;

class Base
{
	const TRANSLATION = [
		'translation' => true,
		'labels' => ['ColumnTranslation']
	];

	const BOOLEAN_VALUE = [
		'filter' => 'boolean',
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

		return $this;
	}

	public function getLabels() : ?array {
		return $this->labels;
	}

	public function getRelationKey($relation) {
		foreach ($this->attributes as $attribute => $properties) {
			if ($attribute === $relation) {
				if (array_key_exists('skip', $properties)) {
					return $properties['skip']['key'];
				}

				return $this->$attribute->getKey();
			}
		}
	}

	public function getRelations(bool $isFilter = false) : array {
		$relations = [];

		foreach ($this->attributes as $attribute => $properties) {
			if ($this->$attribute->getRelation($isFilter)) {
				$relations[$attribute] = [
					'class' => $this->$attribute->getClass(),
					'key' => $this->$attribute->getKey(),
					'filter' => $this->$attribute->getFilterType(),
					'order' => $this->$attribute->getOrder()
				];
			}
		}

		return $relations;
	}

	public function getRelationClass(string $relation) : string {
		return $this->attributes[$relation]['class'];
	}

	public function skipRelation(string $relation) : ?string {
		if (array_key_exists('skip', $this->attributes[$relation])) {
			return $this->attributes[$relation]['skip']['to'];
		}

		return null;
	}

	public function getSkipClass(string $relation) : ?string {
		if (array_key_exists('skip', $this->attributes[$relation])) {
			return $this->attributes[$relation]['skip']['class'];
		}

		return null;
	}

	public function getFilters() {
		$filters = [];

		foreach (array_keys($this->attributes) as $attribute) {
			if ($this->$attribute->getFilterType()) {
				array_push($filters, $attribute);
			}
		}

		return $filters;
	}

	public function getFilterTypes() : array {
		$filterTypes = [];

		foreach (array_keys($this->attributes) as $attribute) {
			$filter = $this->$attribute->getFilterType();

			if ($filter && !in_array($filter, $filterTypes)) {
				array_push($filterTypes, $filter);
			}
		}

		return $filterTypes;
	}

	public function getFiltersByType(string $filterType) : array {
		$filters = [];

		foreach (array_keys($this->attributes) as $attribute) {
			if ($this->$attribute->getFilterType() === $filterType) {
				array_push($filters, $attribute);
			}
		}

		return $filters;
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
		return $this->$attribute->getValueLabel($this->labels);
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

			$reference = array_merge($reference, [$this->$attribute->getKeyLabel() => $this->$attribute->getValueLabel($this->labels)]);
		}

		return $results;
	}
}
