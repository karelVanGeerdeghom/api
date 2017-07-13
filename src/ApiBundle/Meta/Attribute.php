<?php
namespace ApiBundle\Meta;

Class Attribute {
	private $id;
	private $value = null;

	private $type = null;
	private $group = null;
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

	public function export($meta = null):array {
		$data = [
			'key' => $this->getKey(),
			'value' => $this->getValue(),
			'group' => $this->getGroup()
		];

		if ($meta && $this->meta) {
			$data['value'] = [
				'value' => $this->getValue()
			];

			if (array_key_exists('ColumnTranslation', $meta) && in_array('ColumnTranslation', $this->meta)) {
				$data['value']['label'] = null;
				if (array_key_exists($this->id, $meta['ColumnTranslation'])) {
					$data['value']['label'] = 't(' . $meta['ColumnTranslation'][$this->id] . ')';
				}
			}

			if (array_key_exists('ValueTranslation', $meta) && in_array('ValueTranslation', $this->meta)) {
				if (array_key_exists($this->id, $meta['ValueTranslation']) && array_key_exists($this->value, $meta['ValueTranslation'][$this->id])) {
					$data['value']['value'] = 't(' . $meta['ValueTranslation'][$this->id][$this->value] . ')';
				}
			}

			if (array_key_exists('FieldDescription', $meta) && in_array('FieldDescription', $this->meta)) {
				$data['value']['description'] = null;
				if (array_key_exists($this->id, $meta['FieldDescription'])) {
					$data['value']['description'] = 't(' . $meta['FieldDescription'][$this->id] . ')';
				}
			}

			ksort($data['value']);
		}		

		return $data;
	}

	private function getGroup() {
		return $this->group;
	}

	private function getKey() {
		if ($this->type === 'translation') {
			return substr($this->id, 0, -4);
		}

		return $this->id;
	}

	private function getValue() {
		if ($this->type === 'translation') {
			return 't(' . $this->value . ')';
		}

		return $this->value;
	}
}
