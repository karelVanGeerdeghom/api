<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Ingredient extends Base
{
	protected $attributes = [
		'id' => [],
		// TRANSLATIONS
		'title_tid' => self::TRANSLATION,
		'url_tid' => ['translation' => true]
	];
}
