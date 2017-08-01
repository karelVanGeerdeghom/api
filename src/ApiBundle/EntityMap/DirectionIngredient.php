<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class DirectionIngredient extends Base
{
	protected $attributes = [
		'id' => [],
		'Quantitylabel_id' => [],
		'quantity' => [],
		'sortorder' => [],
		// RELATIONS
		'ingredient' => [
			'class' => 'Ingredient',
			'relation' => true,
			'key' => 'ingredient'
		]
	];
}
