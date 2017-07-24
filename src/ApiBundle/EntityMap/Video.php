<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Video extends Base
{
	protected $attributes = [
		'id' => [],
		'Brand_id' => [],
		// TRANSLATIONS
		'title_tid' => self::TRANSLATION,
		'description_short_tid' => self::TRANSLATION,
		'description_long_tid' => self::TRANSLATION
	];
}
