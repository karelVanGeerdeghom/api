<?php

namespace ApiBundle\Entity;

use ApiBundle\Entity\Base;

/**
 * Brand
 */
class Brand extends Base
{
	protected $attributes = [
		'id' => 'id',
		'url' => 'string',
		'title_tid' => 'translation',
	];
}
