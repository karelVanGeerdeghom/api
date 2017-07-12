<?php
namespace ApiBundle\Meta;

use ApiBundle\Meta\Translation;

Class Attribute {
	private $id;
	private $value = null;

	private $type = null;
	private $group = null;
	private $extras = null;

	private $get = [];

	function __construct($id, $data) {
		$this->id = $id;

		foreach ($data as $key => $value) {
			$this->$key = $value;
		}
	}

	public function set($value) {
		$this->value = $value;
	}

	public function get($meta = null) {
		$data = [
			'key' => $this->id,
			'value' => $this->value,
			'group' => $this->group
		];

		if ($this->extras) {
			$data['value'] = [];

			if ($this->type === 'translation') {
				$data['key'] = substr($this->id, 0, -4);
				$data['value']['value_tid'] = $this->value;
			} else {
				$data['value']['value'] = $this->value;
			}

			if ($meta) {
				if (array_key_exists('ColumnTranslation', $meta) && in_array('ColumnTranslation', $this->extras)) {
					$data['value']['label'] = null;
					if (array_key_exists($this->id, $meta['ColumnTranslation'])) {
						unset($data['value']['label']);
						$data['value']['label_tid'] = $meta['ColumnTranslation'][$this->id];
					}
				}

				if (array_key_exists('ValueTranslation', $meta) && in_array('ValueTranslation', $this->extras)) {
					if (array_key_exists($this->value, $meta['ValueTranslation'])) {
						unset($data['value']['value']);
						$data['value']['value_tid'] = $meta['ValueTranslation'][$this->value];
					}
				}

				if (array_key_exists('FieldDescription', $meta) && in_array('FieldDescription', $this->extras)) {
					$data['value']['description'] = null;
					if (array_key_exists($this->id, $meta['FieldDescription'])) {
						unset($data['value']['description']);
						$data['value']['description_tid'] = $meta['FieldDescription'][$this->id];
					}
				}				
			}
		}

		if (is_array($data['value'])) {
			ksort($data['value']);
		}		

		return $data;
	}
}
