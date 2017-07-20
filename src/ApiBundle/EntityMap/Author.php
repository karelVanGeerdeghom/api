<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Author extends Base
{
	protected $attributes = [
		'id' => ['type' => 'id'],
		'function_tid' => ['type' => 'translation'],
		'name' => []
	];
}
