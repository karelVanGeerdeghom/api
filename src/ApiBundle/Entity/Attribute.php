<?php
namespace ApiBundle\Entity;

Class Attribute {
	private $id;
	private $label;
	private $type;
	private $value;

	function __construct($id, $type) {
		$this->id = $id;
		$this->type = $type;
	}

	public function set($value) {
		$this->value = $value;
	}

	public function get():array {
		return [
			'id' => $this->id,
			'type' => $this->type,
			'label' => $this->label,
			'value' => $this->value,
		];
	}
}
