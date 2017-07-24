<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Subbrand extends Base
{
	protected $attributes = [
		'id' => ['type' => 'id'],
		'Brand_id' => [],
		'title_tid' => ['type' => 'translation']
	];
}
