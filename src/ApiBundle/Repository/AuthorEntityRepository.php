<?php

namespace ApiBundle\Repository;

use ApiBundle\Repository\BaseRepository;

class AuthorEntityRepository extends BaseRepository
{
	protected $class = 'Author';
	protected $table = 'Author';
}
