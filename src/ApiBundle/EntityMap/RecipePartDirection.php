<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class RecipePartDirection extends Base
{
	protected $attributes = [
		'id' => [],
		// VALUES
		'sortorder' => [],
		// RELATIONS
		'direction' => [
			'class' => 'Direction',
			'relation' => true,
			'key' => 'directions'
		],
	];
}
