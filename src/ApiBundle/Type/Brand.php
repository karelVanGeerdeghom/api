<?php

namespace ApiBundle\Type;

use ApiBundle\Meta\Base;

class Brand extends Base
{
	protected $attributes = [
		'id' => ['type' => 'id'],
		'url' => [],
		'title_tid' => ['type' => 'translation']
	];
}
