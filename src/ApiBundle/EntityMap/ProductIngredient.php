<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class ProductIngredient extends Base
{
	protected $table = 'Recipe';

	protected $attributes = [
		'id' => [],
		'Recipeid' => [
			'key' => 'product_id'
		],
		// TRANSLATIONS
		'name_tid' => [
			'translation' => true,
			'key' => 'title'
		]
	];
}
