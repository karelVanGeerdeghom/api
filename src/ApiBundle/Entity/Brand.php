<?php

namespace ApiBundle\Entity;

use ApiBundle\Meta\BaseEntity;

/**
 * Brand
 */
class Brand extends BaseEntity
{
	protected $tableName = 'Brand';

	protected $attributes = [
		'id' => self::ID,
		'url' => [],
		'title_tid' => self::TRANSLATION
	];
}
