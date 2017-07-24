<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Segment extends Base
{
	protected $attributes = [
		'id' => [],
		'Brand_id' => [],
		'title_tid' => ['type' => 'translation']
	];
}
