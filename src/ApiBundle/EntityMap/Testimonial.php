<?php

namespace ApiBundle\EntityMap;

use ApiBundle\Meta\Base;

class Testimonial extends Base
{
	protected $attributes = [
		'id' => [],
		'Brand_id' => [],
		'Country_id' => [],
		// TRANSLATIONS
		'text_tid' => self::TRANSLATION
	];
}
