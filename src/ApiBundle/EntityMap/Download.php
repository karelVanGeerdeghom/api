<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Download extends Base
{
	protected $attributes = [
		'id' => [],
		'Brand_id' => [],
		'alignment_hor' => [],
		'alignment_ver' => [],
		// TRANSLATIONS
		'title_tid' => self::TRANSLATION,
		'file_tid' => self::TRANSLATION,
		'info_tid' => ['type' => 'translation'],
		'label_tid' => ['type' => 'translation'],
		'offset_left_tid' => ['type' => 'translation'],
		'offset_top_tid' => ['type' => 'translation'],
		'preview_tid' => ['type' => 'translation'],
		'specs_tid' => ['type' => 'translation']
	];
}
