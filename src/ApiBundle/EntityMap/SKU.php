<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class SKU extends Base
{
	protected $table = 'Product';

	protected $attributes = [
		'id' => [],
		'Brand_id' => [],
		// TRANSLATIONS
		'cluster_tid' => ['translation' => true],
		'GPC_info_tid' => ['translation' => true],
		'SAP_tid' => ['translation' => true],
		'SAP2_tid' => ['translation' => true],
		// VALUES
		'packaging_type' => [],
		'SAP_code' => [
			'labels' => ['ColumnTranslation']
		],
		'shelflife' => [
			'labels' => ['ColumnTranslation']
		],
		'sku' => [
			'labels' => ['ColumnTranslation']
		],
		'halal' => [
			'filter' => 'boolean'
		],
		'kosher' => [
			'filter' => 'enum',
			'labels' => ['ColumnTranslation']
		],
		// RELATIONS
		'download' => [
			'class' => 'DownloadSKU',
			'fetch' => true,
			'relation' => true,
			'key' => 'downloads'
		],
		'packaging' => [
			'class' => 'Packaging',
			'fetch' => true,
			'filter' => 'enum',
			'relation' => true,
			'key' => 'packagings'
		],
		'shape' => [
			'class' => 'Shape',
			'fetch' => true,
			'filter' => 'enum',
			'relation' => true,
			'key' => 'shapes'
		]
	];
}
