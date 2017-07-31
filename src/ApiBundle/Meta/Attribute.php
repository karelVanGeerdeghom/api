<?php

namespace ApiBundle\Meta;

class Attribute
{
	private $id;
	private $value = null;

	private $relation = false;
	private $translation = false;

	private $class = null;
	private $filter = null;
	private $group = null;
	private $key = null;
	private $labels = null;
	private $order = null;
	private $skip = null;

	function __construct($id, $data) {
		$this->id = $id;

		foreach ($data as $key => $value) {
			$this->$key = $value;
		}
	}

	public function set($value) {
		$this->value = $value;
	}

	public function get() {
		return $this->value;
	}

	public function getKeyLabel() : string {
		$key = $this->translation ? substr($this->id, 0, -4) : $this->id;
		$key = $this->key ? $this->key : $key;

		return strtolower($key);
	}

	public function getValueLabel($labels = null) {
		$value = $this->translation && $this->value ? 't(' . $this->value . ')' : $this->value;

		if ($this->relation) {
			$value = [];
		}

		if ($labels && $this->labels) {
			$value = [
				'value' => $value
			];

			if (array_key_exists('ColumnTranslation', $labels) && in_array('ColumnTranslation', $this->labels)) {
				$value['label'] = null;
				if (array_key_exists($this->id, $labels['ColumnTranslation'])) {
					$value['label'] = 't(' . $labels['ColumnTranslation'][$this->id] . ')';
				}
			}

			if (array_key_exists('ValueTranslation', $labels) && in_array('ValueTranslation', $this->labels)) {
				if (array_key_exists($this->id, $labels['ValueTranslation']) && array_key_exists($this->value, $labels['ValueTranslation'][$this->id])) {
					$value['value'] = 't(' . $labels['ValueTranslation'][$this->id][$this->value] . ')';
				}
			}

			if (array_key_exists('FieldDescription', $labels) && in_array('FieldDescription', $this->labels)) {
				$value['description'] = null;
				if (array_key_exists($this->id, $labels['FieldDescription'])) {
					$value['description'] = 't(' . $labels['FieldDescription'][$this->id] . ')';
				}
			}

			ksort($value);
		}

		return $value;
	}

	public function getClass() : ?string {
		return $this->class;
	}

	public function getFilterType() : ?string {
		return $this->filter;
	}

	public function getKey(): ?string {
		if ($this->skip) {
			return $this->skip['key'];
		}

		return $this->key;
	}

	public function getRelation(bool $isFilter = false) : ?string {
		if ($isFilter === false) {
			return $this->relation;
		}
		
		if ($this->filter && $this->relation) {
			return $this->relation;
		}

		return null;
	}

	public function getGroup() : ?string {
		return $this->group;
	}

	public function getOrder() : ?string {
		return $this->order;
	}
}
