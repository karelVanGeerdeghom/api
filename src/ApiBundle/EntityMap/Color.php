<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Color extends Base
{
	protected $attributes = [
		'id' => [],
		// TRANSLATIONS
		'title_tid' => ['translation' => true],
		'internal_tid' => ['translation' => true],
		// VALUES
		'hex_light' => [],
		'hex_dark' => []
	];
}
