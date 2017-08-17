<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Recipe extends Base
{
	protected $table = 'Customerrecipe';

	protected $snapshot = true;

	protected $attributes = [
		'id' => [],
		'Brand_id' => [],
		// TRANSLATIONS
		'title_tid' => self::TRANSLATION,
		'assembly_tid' => self::TRANSLATION,
		'dosage_tid' => self::TRANSLATION,
		'url_tid' => ['translation' => true],
		'seo_title_tid' => ['translation' => true],
		'seo_description_tid' => ['translation' => true],
		// VALUES
		'premium' => self::BOOLEAN_VALUE,
		'new' => self::BOOLEAN_VALUE,
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
		'level' => [
			'filter' => 'float',
			'labels' => ['ColumnTranslation']
		],
		// RELATIONS
		'application' => [
			'class' => 'ApplicationRecipe',
			'fetch' => true,
			'relation' => true,
			'key' => 'applications'
		],
		'author' => [
			'class' => 'AuthorRecipe',
			'fetch' => true,
			'relation' => true,
			'key' => 'authors'
		],
		'download' => [
			'class' => 'DownloadRecipe',
			'fetch' => true,
			'relation' => true,
			'key' => 'downloads'
		],
		'recipepart' => [
			'class' => 'RecipePart',
			'fetch' => true,
			'relation' => true,
			'key' => 'recipeparts'
		]
	];
}
