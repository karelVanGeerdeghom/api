<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Shape extends Base
{
	protected $itemTranslation = true;

	protected $attributes = [
		'id' => [],
		// TRANSLATIONS
		'description_tid' => ['translation' => true]
	];
}
