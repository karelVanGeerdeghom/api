<?php

namespace ApiBundle\Meta;

Trait Set {
	public function set() {
		$arguments = func_get_args();

		if (count($arguments) === 2) {
			$this->setSingle($arguments[1], $arguments[2]);
		}

		if (count($arguments) === 1) {
			$this->setMultiple($arguments);
		}
	}

	private function setSingle($attribute, $value) {
		if (array_key_exists($attribute, $this->attributes)) {
			$this->$attribute->set($value);
		}
	}

	private function setMultiple($data) {
		foreach ($data[0] as $attribute => $value) {
			$this->setSingle($attribute, $value);
		}
	}
}