<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Season extends Base
{
	protected $itemTranslation = true;

	protected $attributes = [
		'id' => [],
		// TRANSLATIONS
		'title_tid' => ['translation' => true]
	];
}
