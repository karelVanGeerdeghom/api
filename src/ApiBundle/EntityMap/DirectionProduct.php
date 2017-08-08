<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class DirectionProduct extends Base
{
	protected $attributes = [
		'id' => [],
		'quantity' => [],
		'Productgroup_id' => [],
		'component_recipe' => [],
		'sortorder' => [],
		// RELATIONS
		'product' => [
			'class' => 'ProductIngredient',
			'fetch' => false,
			'relation' => true,
			'key' => 'ingredient'
		],
		'quantitylabel' => [
			'class' => 'QuantitylabelProduct',
			'fetch' => true,
			'relation' => true,
			'key' => 'quantitylabel'
		]
	];
}
