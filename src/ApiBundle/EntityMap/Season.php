<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Season extends Base
{
	protected $attributes = [
		'id' => [],
		'title_tid' => ['type' => 'translation']
	];
}
