<?php
namespace ApiBundle\Entity;

use ApiBundle\Meta\Base;

/**
 * Brand
 */
class Brand extends Base
{
	protected $tableName = 'Brand';

	protected $attributes = [
		'id' => ['type' => 'id'],
		'url' => [],
		'title_tid' => ['type' => 'translation']
	];
}
