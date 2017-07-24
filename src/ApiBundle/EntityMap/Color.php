<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Color extends Base
{
	protected $attributes = [
		'id' => [],
		// TRANSLATIONS
		'title_tid' => ['type' => 'translation'],
		'internal_tid' => ['type' => 'translation'],
		// VALUES
		'hex_light' => [],
		'hex_dark' => []
	];
}
