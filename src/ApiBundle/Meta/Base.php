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

	public function set() : void {
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

	public function getTable() : string {
		if ($this->table) {
			return $this->table;
		}

		return (new \ReflectionClass($this))->getShortName();
	}

	public function setLabels($labels = null) : void {
		$this->labels = $labels;
	}

	public function getLabels() : ?array {
		return $this->labels;
	}

	public function getRelationKey(string $relation)  : string {
		foreach ($this->attributes as $attribute => $properties) {
			if ($attribute === $relation) {
				return $this->$attribute->getKey();
			}
		}
	}

	public function getRelationDisplay(string $relation) : string {
		foreach ($this->attributes as $attribute => $properties) {
			if ($attribute === $relation) {
				return $this->$attribute->getDisplay();
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
					'fetch' => $this->$attribute->getFetch()
				];
			}
		}

		return $relations;
	}

	public function getRelationClass(string $relation, bool $isSkip = false) : string {
		return $this->$relation->getClass($isSkip);
	}

	public function getSkipTo(string $relation) : ?string {
		if ($this->$relation->getSkipTo()) {
			return $this->$relation->getSkipTo();
		}

		return null;
	}

	public function getFilters() : array {
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

	private function setSingle(string $attribute, $value) : void {
		if (array_key_exists($attribute, $this->attributes)) {
			$this->$attribute->set($value);
		}
	}

	private function setMultiple(array $data) : void {
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
		return $this->$attribute->getExportValue($this->labels);
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

				$reference = array_merge($reference, [$this->$attribute->getExportKey() => $this->$attribute->getExportValue($this->labels)]);
		}

		return $results;
	}
}
