<?php

namespace ApiBundle\Repository;

use ApiBundle\Repository\BaseRepository;

class ProductEntityRepository extends BaseRepository
{
	protected $table = 'Recipe';
	protected $class = 'Product';
}
