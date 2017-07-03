<?php

namespace ApiBundle\Entity;

use ApiBundle\Entity\Attribute;

/**
 * Base
 */
class Base
{
	function __construct() {
		foreach ($this->attributes as $attribute => $type) {
			$this->$attribute = new Attribute($attribute, $type);
		}
	}

	public function set(string $attribute, $value) {
		if (in_array($attribute, $this->attributes)) {
			$this->$attribute->set($value);
		}		
	}

	public function get($data = null): array {
		if (is_string($data) && array_key_exists($data, $this->attributes)) {
			return $this->getSingle($data);
		}

		if (is_array($data) && count(array_intersect(array_keys($this->attributes), $data)) > 0) {
			return $this->getMultiple(array_intersect(array_keys($this->attributes), $data));
		}

		if ($data === null) {
			return $this->getMultiple(array_keys($this->attributes));
		}
	}

	private function getSingle(string $attribute): array {
		return $this->$attribute->get();
	}

	private function getMultiple(array $attributes): array {
		$results = [];
		foreach ($attributes as $attribute) {
			$results[$attribute] = $this->$attribute->get();
		}

		return $results;
	}
}
