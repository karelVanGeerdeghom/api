<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Author extends Base
{
	protected $attributes = [
		'id' => [],
		'name' => [
			'meta' => ['ColumnTranslation']
		],
		// TRANSLATIONS
		'description_tid' => self::TRANSLATION,
		'function_tid' => self::TRANSLATION,
		// RELATIONS
		'downloads' => [
			'relation' => 'download',
			'class' => 'Download'
		]
	];
}
