<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class RecipePartDirections extends Base
{
	protected $attributes = [
		'id' => [],
		// VALUES
		'sortorder' => [],
		// RELATIONS
		'directions' => [
			'class' => 'Directions',
			'relation' => true,
			'key' => 'directions'
		],
	];
}
