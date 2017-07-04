<?php

namespace ApiBundle\Meta;

use ApiBundle\Meta\Get;
use ApiBundle\Meta\Set;
use ApiBundle\Meta\Attribute;

/**
 * BaseEntity
 */
class BaseEntity
{
	use Set;
	use Get;

	const ID = [
		'type' => 'id'
	];

	const TRANSLATION = [
		'type' => 'translation',
		'meta' => ['label']
	];

	function __construct() {
		foreach ($this->attributes as $attribute => $options) {
			$this->$attribute = new Attribute($attribute, $options);
		}
	}
}
