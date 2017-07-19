<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Season extends Base
{
	protected $attributes = [
		'id' => ['type' => 'id'],
		'title_tid' => ['type' => 'translation']
	];
}
