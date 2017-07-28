<?php

namespace ApiBundle\Repository;

use ApiBundle\Repository\BaseRepository;

class SKUEntityRepository extends BaseRepository
{
	protected $class = 'SKU';
	protected $table = 'Product';
}