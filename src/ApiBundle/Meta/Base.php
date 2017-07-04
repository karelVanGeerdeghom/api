<?php

namespace ApiBundle\Meta;

use ApiBundle\Meta\Attribute;
use ApiBundle\Meta\Get;
use ApiBundle\Meta\Set;

/**
 * Base
 */
class Base
{
	use Set;
	use Get;

	function __construct() {
		foreach ($this->attributes as $attribute => $options) {
			$this->$attribute = new Attribute($attribute, $options);
		}
	}
}
