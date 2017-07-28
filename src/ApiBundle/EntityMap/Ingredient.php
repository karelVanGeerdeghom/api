<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Ingredient extends Base
{
	protected $attributes = [
		'id' => [],
		// TRANSLATIONS
		'title_tid' => ['translation' => true],
		'url_tid' => ['translation' => true]
	];
}
