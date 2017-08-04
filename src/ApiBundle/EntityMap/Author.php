<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Author extends Base
{
	protected $attributes = [
		'id' => [],
		// TRANSLATIONS
		'description_tid' => ['translation' => true],
		'function_tid' => self::TRANSLATION,
		// VALUES
		'name' => [
			'labels' => ['ColumnTranslation']
		],
		// RELATIONS
		'download' => [
			'class' => 'AuthorDownload',
			'fetch' => true,
			'relation' => true,
			'key' => 'downloads'
		]
	];
}
