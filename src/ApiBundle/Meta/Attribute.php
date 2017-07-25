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

	public function getKey() : string {
		$key = $this->translation ? substr($this->id, 0, -4) : $this->id;
		$key = $this->key ? $this->key : $key;

		return $key;
	}

	public function getValue($labels = null) {
		$value = $this->translation && $this->value ? 't(' . $this->value . ')' : $this->value;

		if ($labels && $this->labels) {
			$value = [
				'value' => $value
			];

			if (array_key_exists('ColumnTranslation', $labels) && in_array('ColumnTranslation', $this->labels)) {
				$value['key'] = null;
				if (array_key_exists($this->id, $labels['ColumnTranslation'])) {
					$value['key'] = 't(' . $labels['ColumnTranslation'][$this->id] . ')';
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

	public function getFilter() : ?string {
		return $this->filter;
	}

	public function getRelation() : ?string {
		return $this->relation;
	}

	public function getFilterRelation() : ?string {
		if ($this->filter && $this->relation) {
			return $this->relation;
		}

		return null;
	}

	public function getGroup() : ?string {
		return $this->group;
	}
}
