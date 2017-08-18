<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Testimonial extends Base
{
	protected $itemTranslation = true;

	protected $attributes = [
		'id' => [],
		'Brand_id' => [],
		'Country_id' => [],
		// TRANSLATIONS
		'text_tid' => self::TRANSLATION,
		// RELATIONS
		'author' => [
			'class' => 'Author',
			'fetch' => true,
			'relation' => true,
			'key' => 'authors'
		]
	];
}
