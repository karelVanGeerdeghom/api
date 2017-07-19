<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Testimonial extends Base
{
	protected $attributes = [
		'id' => ['type' => 'id'],
		'Brand_id' => [],
		'Country_id' => [],
		'text_tid' => ['type' => 'translation']
	];
}
