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
		'sortorder' => [],
		// RELATIONS
		'recipepartdirections' => [
			'class' => 'RecipePartDirections',
			'relation' => true,
			'key' => 'recipepartdirections'
		]
	];
}
