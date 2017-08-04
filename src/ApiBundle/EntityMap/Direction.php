<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Direction extends Base
{
	protected $attributes = [
		'id' => [],
		// TRANSLATIONS
		'title_tid' => self::TRANSLATION,
		// RELATIONS
		'directioningredient' => [
			'class' => 'DirectionIngredient',
			'fetch' => true,
			'relation' => true,
			'key' => 'direction_ingredients'
		],
		'directionproduct' => [
			'class' => 'DirectionProduct',
			'fetch' => true,
			'relation' => true,
			'key' => 'direction_ingredients'
		]
	];
}
