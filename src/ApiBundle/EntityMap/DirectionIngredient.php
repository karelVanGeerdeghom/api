<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class DirectionIngredient extends Base
{
	protected $attributes = [
		'id' => [],
		'quantity' => [],
		'sortorder' => [],
		// RELATIONS
		'ingredient' => [
			'class' => 'Ingredient',
			'fetch' => true,
			'relation' => true,
			'key' => 'ingredient'
		],
		'quantitylabel' => [
			'class' => 'Quantitylabel',
			'fetch' => true,
			'relation' => true,
			'key' => 'quantitylabel'
		]
	];
}
