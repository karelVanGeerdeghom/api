<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Download extends Base
{
	protected $attributes = [
		'id' => [],
		'Brand_id' => [],
		// TRANSLATIONS
		'title_tid' => self::TRANSLATION,
		'file_tid' => self::TRANSLATION,
		'info_tid' => ['translation' => true],
		'label_tid' => ['translation' => true],
		'offset_left_tid' => ['translation' => true],
		'offset_top_tid' => ['translation' => true],
		'preview_tid' => ['translation' => true],
		'specs_tid' => ['translation' => true],
		// VALUES
		'alignment_hor' => [],
		'alignment_ver' => []
	];
}
