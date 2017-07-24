<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Technique extends Base
{
	protected $attributes = [
		'id' => [],
		'Brand_id' => [],
		'title_tid' => ['type' => 'translation'],
		'url_tid' => ['type' => 'translation']
	];
}
