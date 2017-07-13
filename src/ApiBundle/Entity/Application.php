<?php
namespace ApiBundle\Entity;

use ApiBundle\Meta\Base;

/**
 * Application
 */
class Application extends Base
{
	protected $attributes = [
		'id' => ['type' => 'id'],
		'Brand_id' => [],
		'title_tid' => ['type' => 'translation'],
		'type' => []
	];
}
