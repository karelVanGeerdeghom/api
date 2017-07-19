<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Video extends Base
{
	protected $attributes = [
		'id' => ['type' => 'id'],
		'Brand_id' => [],
		'title_tid' => ['type' => 'translation'],
		'description_short_tid' => ['type' => 'translation'],
		'description_long_tid' => ['type' => 'translation']
	];
}
