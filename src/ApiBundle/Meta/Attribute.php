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
			return $this->getLabelValue();
		}

		return $this->getValue();
	}

	public function group() {
		return $this->group;
	}

	private function getValue() {
		return $this->value;
	}

	private function getLabelValue() {
		return [
			'label' => $this->id,
			'value' => $this->value
		];
	}
}
