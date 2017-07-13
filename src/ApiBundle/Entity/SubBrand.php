<?php
namespace ApiBundle\Entity;

use ApiBundle\Meta\Base;

class SubBrand extends Base
{
	protected $table = 'Subbrand';

	protected $attributes = [
		'id' => ['type' => 'id'],
		'Brand_id' => [],
		'title_tid' => ['type' => 'translation']
	];
}
