<?php

namespace ApiBundle\Meta;

Trait Get {
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
			if ($this->$attribute->group()) {
				if (!array_key_exists($this->$attribute->group(), $results)) {
					$results[$this->$attribute->group()] = [];
				}

				$results[$this->$attribute->group()][$attribute] = $this->$attribute->get();
			} else {
				$results[$attribute] = $this->$attribute->get();
			}			
		}

		return $results;
	}
}