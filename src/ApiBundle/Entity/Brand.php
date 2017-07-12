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
		'id' => ['type' => 'id'],
		'url' => [],
		'title_tid' => ['type' => 'translation']
	];
}
