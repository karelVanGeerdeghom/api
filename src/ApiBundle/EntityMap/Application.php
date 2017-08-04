<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Application extends Base
{
	protected $attributes = [
		'id' => [],
		'Brand_id' => [],
		// TRANSLATIONS
		'title_tid' => self::TRANSLATION,
		// VALUES
		'type' => [],
		// RELATIONS
		'download' => [
			'class' => 'DownloadApplication',
			'fetch' => true,
			'relation' => true,
			'key' => 'downloads'
		]
	];
}
