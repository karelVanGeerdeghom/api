<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Product extends Base
{
	const PERCENTAGE_VALUE = [
		'group' => 'percentage_values',
		'filter' => 'float',
		'labels' => ['ColumnTranslation']
	];

	const TASTE_VALUE = [
		'group' => 'taste_values',
		'filter' => 'float',
		'labels' => ['ColumnTranslation', 'FieldDescription']
	];

	const TASTE_BOOLEAN = [
		'group' => 'taste_booleans',
		'filter' => 'boolean',
		'labels' => ['ColumnTranslation']
	];

	const ENUM_VALUE = [
		'filter' => 'enum',
		'labels' => ['ColumnTranslation', 'ValueTranslation']
	];

	protected $table = 'Recipe';

	protected $attributes = [
		'id' => [],
		'Brand_id' => [],
		'Recipeid' => [],
		// TRANSLATIONS
		'content_tid' => ['translation' => true],
		'search_keywords_tid' => ['translation' => true],
		'seo_description_tid' => ['translation' => true],
		'seo_title_tid' => ['translation' => true],
		'beans_origins_tid' => self::TRANSLATION,
		'colour_tid' => self::TRANSLATION,
		'description_tid' => self::TRANSLATION,
		'extrainfo_tid' => self::TRANSLATION,
		'fabric_tid' => self::TRANSLATION,
		'howtouse_tid' => self::TRANSLATION,
		'legal_denomination_tid' => self::TRANSLATION,
		'mainfeature_tid' => self::TRANSLATION,
		'mto_tid' => self::TRANSLATION,
		'name_tid' => self::TRANSLATION,
		'originofnuts_tid' => self::TRANSLATION,
		'size_tid' => self::TRANSLATION,
		'tastedescription_tid' => self::TRANSLATION,
		// FLOAT VALUES
		'alcohol_percentage' => self::PERCENTAGE_VALUE,
		'almonds_percentage' => self::PERCENTAGE_VALUE,
		'apple_percentage' => self::PERCENTAGE_VALUE,
		'apricot_percentage' => self::PERCENTAGE_VALUE,
		'butter_percentage' => self::PERCENTAGE_VALUE,
		'cacao_butter_percentage' => self::PERCENTAGE_VALUE,
		'cacao_percentage' => self::PERCENTAGE_VALUE,
		'caramel_percentage' => self::PERCENTAGE_VALUE,
		'cereals_biscuitees_percentage' => self::PERCENTAGE_VALUE,
		'chocolate_percentage' => self::PERCENTAGE_VALUE,
		'cocoa_powder_percentage' => self::PERCENTAGE_VALUE,
		'cream_percentage' => self::PERCENTAGE_VALUE,
		'dairy_percentage' => self::PERCENTAGE_VALUE,
		'fat_percentage' => self::PERCENTAGE_VALUE,
		'fruit_percentage' => self::PERCENTAGE_VALUE,
		'hazelnut_percentage' => self::PERCENTAGE_VALUE,
		'maltitol_percentage' => self::PERCENTAGE_VALUE,
		'milk_percentage' => self::PERCENTAGE_VALUE,
		'nut_percentage' => self::PERCENTAGE_VALUE,
		'pecan_percentage' => self::PERCENTAGE_VALUE,
		'pistachios_percentage' => self::PERCENTAGE_VALUE,
		'raspberry_percentage' => self::PERCENTAGE_VALUE,
		'sugar_percentage' => self::PERCENTAGE_VALUE,
		'vegetable_fat_percentage' => self::PERCENTAGE_VALUE,

		'cocoa_cocoa_butter' => self::PERCENTAGE_VALUE,
		'cocoa_fatfree_cocoa' => self::PERCENTAGE_VALUE,
		'fat_milkfat' => self::PERCENTAGE_VALUE,
		'fat_cocoa_butter' => self::PERCENTAGE_VALUE,
		'milk_fatfree_milk' => self::PERCENTAGE_VALUE,
		'milk_milkfat' => self::PERCENTAGE_VALUE,

		'aeration_level' => self::PERCENTAGE_VALUE,
		'coffee' => self::PERCENTAGE_VALUE,
		'paillete_pur_beurre_percentage' => self::PERCENTAGE_VALUE,
		// TASTE BOOLEANS
		'taste_almond' => self::TASTE_BOOLEAN,
		'taste_apple' => self::TASTE_BOOLEAN,
		'taste_banana' => self::TASTE_BOOLEAN,
		'taste_biscuit' => self::TASTE_BOOLEAN,
		'taste_cacao' => self::TASTE_BOOLEAN,
		'taste_caramel' => self::TASTE_BOOLEAN,
		'taste_cherry' => self::TASTE_BOOLEAN,
		'taste_chocolate' => self::TASTE_BOOLEAN,
		'taste_coconut' => self::TASTE_BOOLEAN,
		'taste_coffee' => self::TASTE_BOOLEAN,
		'taste_creamy' => self::TASTE_BOOLEAN,
		'taste_dark_chocolate' => self::TASTE_BOOLEAN,
		'taste_espresso' => self::TASTE_BOOLEAN,
		'taste_fruits' => self::TASTE_BOOLEAN,
		'taste_hazelnut' => self::TASTE_BOOLEAN,
		'taste_lemon' => self::TASTE_BOOLEAN,
		'taste_liquor' => self::TASTE_BOOLEAN,
		'taste_marbled_chocolate' => self::TASTE_BOOLEAN,
		'taste_marzipan' => self::TASTE_BOOLEAN,
		'taste_milk_chocolate' => self::TASTE_BOOLEAN,
		'taste_natural_flavor' => self::TASTE_BOOLEAN,
		'taste_natural' => self::TASTE_BOOLEAN,
		'taste_neutral' => self::TASTE_BOOLEAN,
		'taste_nuts' => self::TASTE_BOOLEAN,
		'taste_orange' => self::TASTE_BOOLEAN,
		'taste_pineapple' => self::TASTE_BOOLEAN,
		'taste_pistachivo' => self::TASTE_BOOLEAN,
		'taste_raspberry' => self::TASTE_BOOLEAN,
		'taste_strawberry' => self::TASTE_BOOLEAN,
		'taste_vanilla' => self::TASTE_BOOLEAN,
		'taste_white_chocolate' => self::TASTE_BOOLEAN,
		// TASTES
		'bitter' => self::TASTE_VALUE,
		'caramel' => self::TASTE_VALUE,
		'cocoa_taste' => self::TASTE_VALUE,
		'cream' => self::TASTE_VALUE,
		'floral' => self::TASTE_VALUE,
		'milk' => self::TASTE_VALUE,
		'roasted' => self::TASTE_VALUE,
		'sour' => self::TASTE_VALUE,
		'spicy' => self::TASTE_VALUE,
		'sweet' => self::TASTE_VALUE,
		'vanilla' => self::TASTE_VALUE,
		'vegetal' => self::TASTE_VALUE,
		'woody' => self::TASTE_VALUE,
		// BOOLEAN VALUES
		'add_prefix' => self::BOOLEAN_VALUE,
		'azo' => self::BOOLEAN_VALUE,
		'bio' => self::BOOLEAN_VALUE,
		'cocoa_horizons_program' => self::BOOLEAN_VALUE,
		'decantation' => self::BOOLEAN_VALUE,
		'fairtrade_sourcing_prog_cocoa' => self::BOOLEAN_VALUE,
		'fairtrade' => self::BOOLEAN_VALUE,
		'from_natural_origin' => self::BOOLEAN_VALUE,
		'lenotre' => self::BOOLEAN_VALUE,
		'made_with_100percent_purecocoa_butter' => self::BOOLEAN_VALUE,
		'made_with_finest_cocoa_beans' => self::BOOLEAN_VALUE,
		'made_with_natural_vanilla' => self::BOOLEAN_VALUE,
		'new' => self::BOOLEAN_VALUE,
		'non_azo' => self::BOOLEAN_VALUE,
		'organic' => self::BOOLEAN_VALUE,
		'rain_forest_alliance' => self::BOOLEAN_VALUE,
		'standard' => self::BOOLEAN_VALUE,
		'sustainable_cocoa' => self::BOOLEAN_VALUE,
		'sustainable_palm_mass_balance' => self::BOOLEAN_VALUE,
		'sustainable_palm_traceable' => self::BOOLEAN_VALUE,
		'utz_mass_balance_full_100percent' => self::BOOLEAN_VALUE,
		'without_licithine' => self::BOOLEAN_VALUE,
		// ENUM VALUES
		'based' => self::ENUM_VALUE,
		'chocolate_type' => self::ENUM_VALUE,
		'cocoa_intensity' => self::ENUM_VALUE,
		'fluidity' => self::ENUM_VALUE,
		'melting_profile' => self::ENUM_VALUE,
		'ph' => self::ENUM_VALUE,
		'prominent_descriptor' => self::ENUM_VALUE,
		'provenance' => self::ENUM_VALUE,
		'roast_level' => self::ENUM_VALUE,
		'size_type' => self::ENUM_VALUE,
		'texture' => self::ENUM_VALUE,
		'vegetable_fat' => self::ENUM_VALUE,
		// RELATIONS
		'application' => [
			'class' => 'ApplicationProduct',
			'fetch' => true,
			'filter' => 'enum',
			'relation' => true,
			'display' => 'titleTid',
			'key' => 'applications'
		],
		'color' => [
			'class' => 'Color',
			'fetch' => true,
			'filter' => 'enum',
			'relation' => true,
			'display' => 'titleTid',
			'key' => 'colors'
		],
		'download' => [
			'class' => 'DownloadProduct',
			'fetch' => true,
			'relation' => true,
			'key' => 'downloads'
		],
		'season' => [
			'class' => 'Season',
			'fetch' => true,
			'filter' => 'enum',
			'relation' => true,
			'display' => 'titleTid',
			'key' => 'seasons'
		],
		'segment' => [
			'class' => 'Segment',
			'fetch' => true,
			'filter' => 'enum',
			'relation' => true,
			'display' => 'titleTid',
			'key' => 'segments'
		],
		'sku' => [
			'class' => 'SKU',
			'fetch' => true,
			'filter' => 'relation',
			'relation' => true,
			'key' => 'availabilities'
		],
		'subbrand' => [
			'class' => 'Subbrand',
			'fetch' => true,
			'filter' => 'enum',
			'relation' => true,
			'display' => 'titleTid',
			'key' => 'subbrands'
		],
		'technique' => [
			'class' => 'Technique',
			'fetch' => true,
			'filter' => 'enum',
			'relation' => true,
			'display' => 'titleTid',
			'key' => 'techniques'
		],
		'testimonial' => [
			'class' => 'Testimonial',
			'fetch' => true,
			'relation' => true,
			'key' => 'testimonials'
		]
	];
}
