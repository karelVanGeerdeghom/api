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
		//
		'level' => [
			'filter' => 'float',
			'labels' => ['ColumnTranslation']
		],
		// RELATIONS
		'recipepart' => [
			'class' => 'RecipePart',
			'relation' => true,
			'key' => 'recipeparts',
			'order' => 'sortorder'
		],
		'application' => [
			'class' => 'RecipeApplication',
			'relation' => true,
			'key' => 'applications'
		],
		'author' => [
			'class' => 'RecipeAuthor',
			'relation' => true,
			'key' => 'authors'
		],
		'download' => [
			'class' => 'RecipeDownload',
			'relation' => true,
			'key' => 'downloads'
		],
	];
}
