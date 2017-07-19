<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Technique extends Base
{
	protected $attributes = [
		'id' => ['type' => 'id'],
		'Brand_id' => [],
		'title_tid' => ['type' => 'translation'],
		'url_tid' => ['type' => 'translation']
	];
}
