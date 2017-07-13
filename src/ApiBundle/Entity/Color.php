<?php
namespace ApiBundle\Entity;

use ApiBundle\Meta\Base;

class Color extends Base
{
	protected $attributes = [
		'id' => ['type' => 'id'],
		'commercial_tid' => ['type' => 'translation'],
		'internal_tid' => ['type' => 'translation'],
		'hex_light' => [],
		'hex_dark' => []
	];
}
