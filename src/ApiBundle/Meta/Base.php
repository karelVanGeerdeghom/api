<?php
namespace ApiBundle\Meta;

use ApiBundle\Meta\Attribute;

/**
 * Base
 */
class Base
{
	protected $meta = null;
	protected $attributes = [];

	function __construct() {
		foreach ($this->attributes as $attribute => $properties) {
			$this->$attribute = new Attribute($attribute, $properties);
		}
	}

	public function setMeta($meta = null) {
		$this->meta = $meta;
	}

	public function set() {
		$arguments = func_get_args();

		if (count($arguments) === 2) {
			$this->setSingle($arguments[0], $arguments[1]);
		}

		if (count($arguments) === 1) {
			$this->setMultiple($arguments[0]);
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

	private function setSingle($attribute, $value) {
		if (array_key_exists($attribute, $this->attributes)) {
			$this->$attribute->set($value);
		}
	}

	private function setMultiple($data) {
		foreach ($data as $attribute => $value) {
			$this->setSingle($attribute, $value);
		}
	}

	private function getSingle(string $attribute): array {
		return $this->$attribute->get($this->meta);
	}

	private function getMultiple(array $attributes): array {
		$results = [];
		foreach ($attributes as $attribute) {
			$attributeData = $this->$attribute->get($this->meta);

			$reference = &$results;
			if ($attributeData['group']) {
				if (!array_key_exists($attributeData['group'], $results)) {
					$results[$attributeData['group']] = [];
				}

				$reference = &$results[$attributeData['group']];
			}

			$reference = array_merge($reference, [$attributeData['key'] => $attributeData['value']]);
		}

		return $results;
	}
}
