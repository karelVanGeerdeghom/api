<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Recipe extends Base
{
	protected $table = 'Customerrecipe';

	protected $attributes = [
		'id' => [],
		'Brand_id' => [],
		// TRANSLATIONS
		'title_tid' => ['translation' => true],
		'assembly_tid' => ['translation' => true],
		'dosage_tid' => ['translation' => true],
		'url_tid' => ['translation' => true],
		'seo_title_tid' => ['translation' => true],
		'seo_description_tid' => ['translation' => true],
		// VALUES
		'premium' => [
			'filter' => 'boolean'
		],
		'new' => [
			'filter' => 'boolean'
		],
		'dietaryneed_vegan' => [
			'filter' => 'boolean'
		],
		'dietaryneed_reduced_in_sugar' => [
			'filter' => 'boolean'
		],
		'dietaryneed_nut_free' => [
			'filter' => 'boolean'
		],
		'dietaryneed_dairy_lactose_free' => [
			'filter' => 'boolean'
		],
		'dietaryneed_gluten_free' => [
			'filter' => 'boolean'
		],
		//
		'level' => [
			'filter' => 'float'
		],
		// RELATIONS
		'recipepart' => [
			'class' => 'RecipePart',
			'relation' => true,
			'key' => 'recipeparts'
		],
	];
}
