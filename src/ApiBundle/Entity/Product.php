<?php
namespace ApiBundle\Entity;

use ApiBundle\Meta\Base;

/**
 * Product
 */
class Product extends Base
{
	protected $attributes = [
		'id' => [],
		'Brand_id' => [],
		'fat_percentage' => [
			'group' => 'percentage_values',
			'filter' => 'float',
			'label' => true
		],
		'cacao_percentage' => [
			'group' => 'percentage_values',
			'filter' => 'float',
			'label' => true
		],
		'taste_almond' => [
			'group' => 'taste_booleans',
			'filter' => 'boolean',
			'label' => true
		],
		'taste_apple' => [
			'group' => 'taste_booleans',
			'filter' => 'boolean',
			'label' => true
		]
	];
}
