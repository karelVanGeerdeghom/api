<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Directions extends Base
{
	protected $attributes = [
		'id' => [],
		// TRANSLATIONS
		'title_tid' => self::TRANSLATION,
		// RELATIONS
		'ingredient' => [
			'class' => 'Ingredient',
			'relation' => true,
			'key' => 'ingredients'
		],
	];
}
