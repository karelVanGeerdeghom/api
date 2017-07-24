<?php

namespace ApiBundle\Repository;

use ApiBundle\Repository\BaseRepository;

class AuthorEntityRepository extends BaseRepository
{
	protected $table = 'Author';
	protected $class = 'Author';
}
