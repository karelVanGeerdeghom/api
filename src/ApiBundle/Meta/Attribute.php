<?php
namespace ApiBundle\Meta;

Class Attribute {
	private $id;
	private $value = '';

	private $filter = false;
	private $label = false;
	private $group = false;

	function __construct($id, $options) {
		$this->id = $id;

		if (array_key_exists('filter', $options)) {
			$this->filter = $options['filter'];
		}
		if (array_key_exists('label', $options)) {
			$this->label = $options['label'];
		}
		if (array_key_exists('group', $options)) {
			$this->group = $options['group'];
		}
	}

	public function set($value) {
		$this->value = $value;
	}

	public function get() {
		if ($this->label) {
			return [
				'label' => $this->id,
				'value' => $this->value
			];
		}

		return $this->value;
	}

	public function group() {
		return $this->group;
	}
}
