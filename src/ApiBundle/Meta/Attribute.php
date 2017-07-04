<?php
namespace ApiBundle\Meta;

Class Attribute {
	private $id;
	private $value = '';

	private $type = false;
	private $label = false;
	private $group = false;
	private $meta = false;

	function __construct($id, $options) {
		$this->id = $id;

		foreach ($options as $key => $value) {
			$this->$key = $value;
		}
	}

	public function set($value) {
		$this->value = $value;
	}

	public function get() {
		if ($this->meta) {
			return $this->getMetaValue();
		} else {
			return $this->getValue();
		}
	}

	public function group() {
		return $this->group;
	}

	private function getValue() {
		return $this->value;
	}

	private function getMetaValue() {
		$return['value'] = $this->value;

		foreach ($this->meta as $option) {
			$return[$option] = '';
		}

		return $return;
	}
}
