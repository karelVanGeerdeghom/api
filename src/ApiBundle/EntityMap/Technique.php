<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Technique extends Base
{
	protected $attributes = [
		'id' => [],
		'Brand_id' => [],
		// TRANSLATIONS
		'title_tid' => self::TRANSLATION,
		'url_tid' => self::TRANSLATION
	];
}
