<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Subbrand extends Base
{
	protected $itemTranslation = true;

	protected $attributes = [
		'id' => [],
		'Brand_id' => [],
		// TRANSLATIONS
		'title_tid' => ['translation' => true]
	];
}
