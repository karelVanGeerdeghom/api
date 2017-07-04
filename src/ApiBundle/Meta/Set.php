<?php

namespace ApiBundle\Meta;

Trait Set {
	public function set(string $attribute, $value) {
		if (array_key_exists($attribute, $this->attributes)) {
			$this->$attribute->set($value);
		}
	}
}