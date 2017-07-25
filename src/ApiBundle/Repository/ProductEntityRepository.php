<?php

namespace ApiBundle\Repository;

use ApiBundle\Repository\BaseRepository;

class ProductEntityRepository extends BaseRepository
{
	protected $class = 'Product';
	protected $table = 'Recipe';
}
