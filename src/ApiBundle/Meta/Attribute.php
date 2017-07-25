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
	private $label = null;
	private $meta = null;

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
		$key = $this->label ? $this->label : $key;

		return $key;
	}

	public function getValue($meta = null) {
		$value = $this->translation && $this->value ? 't(' . $this->value . ')' : $this->value;

		if ($meta && $this->meta) {
			$value = [
				'value' => $value
			];

			if (array_key_exists('ColumnTranslation', $meta) && in_array('ColumnTranslation', $this->meta)) {
				$value['label'] = null;
				if (array_key_exists($this->id, $meta['ColumnTranslation'])) {
					$value['label'] = 't(' . $meta['ColumnTranslation'][$this->id] . ')';
				}
			}

			if (array_key_exists('ValueTranslation', $meta) && in_array('ValueTranslation', $this->meta)) {
				if (array_key_exists($this->id, $meta['ValueTranslation']) && array_key_exists($this->value, $meta['ValueTranslation'][$this->id])) {
					$value['value'] = 't(' . $meta['ValueTranslation'][$this->id][$this->value] . ')';
				}
			}

			if (array_key_exists('FieldDescription', $meta) && in_array('FieldDescription', $this->meta)) {
				$value['description'] = null;
				if (array_key_exists($this->id, $meta['FieldDescription'])) {
					$value['description'] = 't(' . $meta['FieldDescription'][$this->id] . ')';
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

	public function getGroup() : ?string {
		return $this->group;
	}
}
