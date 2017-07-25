<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class SKU extends Base
{
	protected $attributes = [
		'id' => [],
		'Brand_id' => [],
		// TRANSLATIONS
		'cluster_tid' => self::TRANSLATION,
		'GPC_info_tid' => self::TRANSLATION,
		'SAP_tid' => self::TRANSLATION,
		'SAP2_tid' => self::TRANSLATION,
		// VALUES
		'packaging_type' => [],
		'SAP_code' => [],
		'shelflife' => [],
		'sku' => [],
		'sortorder' => [],
		'halal' => [],
		'kosher' => []
	];
}
