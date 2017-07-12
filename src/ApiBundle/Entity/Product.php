<?php
namespace ApiBundle\Entity;

use ApiBundle\Meta\Base;

/**
 * Product
 */
class Product extends Base
{
	const PERCENTAGE_VALUE = [
		'group' => 'percentage_values',
		'type' => 'float',
		'extras' => ['ColumnTranslation']
	];

	const TASTE_VALUE = [
		'group' => 'taste_values',
		'type' => 'float',
		'extras' => ['ColumnTranslation', 'FieldDescription']
	];

	const TASTE_BOOLEAN = [
		'group' => 'taste_booleans',
		'type' => 'boolean',
		'extras' => ['ColumnTranslation']
	];

	const ENUM_VALUE = [
		'type' => 'enum',
		'extras' => ['ColumnTranslation', 'ValueTranslation']
	];

	protected $tableName = 'Recipe';

	protected $attributes = [
		'id' => ['type' => 'id'],
		'Brand_id' => [],

		'content_tid' => ['type' => 'translation'],
		'description_tid' => [
			'type' => 'translation',
			'extras' => ['ColumnTranslation']
		],

		'cacao_percentage' => self::PERCENTAGE_VALUE,
		'fat_percentage' => self::PERCENTAGE_VALUE,
		'sugar_percentage' => self::PERCENTAGE_VALUE,

		'bitter' => self::TASTE_VALUE,
		'caramel' => self::TASTE_VALUE,
		'cocoa_taste' => self::TASTE_VALUE,

		'taste_almond' => self::TASTE_BOOLEAN,
		'taste_apple' => self::TASTE_BOOLEAN,
		'taste_banana' => self::TASTE_BOOLEAN,

		'based' => self::ENUM_VALUE,
		'chocolate_type' => self::ENUM_VALUE,
		'cocoa_intensity' => self::ENUM_VALUE,
		'fluidity' => self::ENUM_VALUE,
		'melting_profile' => self::ENUM_VALUE,
		'ph' => self::ENUM_VALUE,
		'roast_level' => self::ENUM_VALUE,
		'prominent_descriptor' => self::ENUM_VALUE,
		'provenance' => self::ENUM_VALUE,
		'size_type' => self::ENUM_VALUE,
		'texture' => self::ENUM_VALUE,
		'vegetable_fat' => self::ENUM_VALUE
	];
}
