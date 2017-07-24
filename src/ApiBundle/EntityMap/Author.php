<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Author extends Base
{
	protected $attributes = [
		'id' => [],
		// TRANSLATIONS
		'description_tid' => self::TRANSLATION,
		'function_tid' => self::TRANSLATION,
		// VALUES
		'name' => [
			'meta' => ['ColumnTranslation']
		],
		// RELATIONS
		'downloads' => [
			'relation' => 'download',
			'class' => 'Download'
		]
	];
}
