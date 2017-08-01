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
			'relation' => true,
			'key' => 'directioningredients'
		],
	];
}
