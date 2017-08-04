<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class RecipePart extends Base
{
	protected $table = 'Customerrecipepart';

	protected $attributes = [
		'id' => [],
		// TRANSLATIONS
		'title_tid' => self::TRANSLATION,
		// VALUES
		'web_id' => [],
		// RELATIONS
		'recipepartdirection' => [
			'class' => 'RecipePartDirection',
			'fetch' => true,
			'relation' => true,
			'key' => 'directions',
			'skip' => [
				'to' => 'direction',
				'class' => 'Direction'
			]
		]
	];
}
