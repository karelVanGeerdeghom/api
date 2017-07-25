<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Segment extends Base
{
	protected $attributes = [
		'id' => [],
		'Brand_id' => [],
		// TRANSLATIONS
		'title_tid' => ['translation' => true]
	];
}
