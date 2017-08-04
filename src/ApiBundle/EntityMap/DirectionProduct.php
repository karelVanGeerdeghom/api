<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class DirectionProduct extends Base
{
	protected $attributes = [
		'id' => [],
		'quantity' => [],
		'Productgroup_id' => [],
		'Quantitylabel_id' => [],
		'component_recipe' => [],
		'sortorder' => [],
		// RELATIONS
		'product' => [
			'class' => 'Product',
			'fetch' => false,
			'relation' => true,
			'key' => 'product'
		],
		// 'quantitylabel' => [
		// 	'class' => 'Quantitylabel',
		// 	'relation' => true,
		// 	'key' => 'quantitylabel'
		// ]
	];
}
