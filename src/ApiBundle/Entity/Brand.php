<?php
namespace ApiBundle\Entity;

use ApiBundle\Meta\Base;

class Brand extends Base
{
	protected $attributes = [
		'id' => ['type' => 'id'],
		'url' => [],
		'title_tid' => ['type' => 'translation']
	];
}
