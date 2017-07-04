<?php

namespace ApiBundle\Entity;

use ApiBundle\Meta\Base;

/**
 * Brand
 */
class Brand extends Base
{
	protected $attributes = [
		'id' => [
			'type' => 'id'
		],
		'url' => [
			'type' => 'string'
		],
		'title_tid' => [
			'type' => 'translation'
		]
	];
}
