<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Packaging extends Base
{
	protected $attributes = [
		'id' => [],
		// TRANSLATIONS
		'1_1_amount_tid' => self::TRANSLATION,
		'1_1_type_tid' => self::TRANSLATION,
		'1_2_amount_tid' => self::TRANSLATION,
		'1_2_type_tid' => self::TRANSLATION,
		'2_1_amount_tid' => self::TRANSLATION,
		'2_1_type_tid' => self::TRANSLATION,
		'2_2_amount_tid' => self::TRANSLATION,
		'2_2_type_tid' => self::TRANSLATION,
		'3_1_amount_tid' => self::TRANSLATION,
		'3_1_type_tid' => self::TRANSLATION,
		'3_2_amount_tid' => self::TRANSLATION,
		'3_2_type_tid' => self::TRANSLATION,
		// VALUES
		'packagingid' => [],
		'unique_packaging' => []
	];
}
