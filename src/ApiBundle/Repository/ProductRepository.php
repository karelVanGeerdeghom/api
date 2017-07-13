<?php
namespace ApiBundle\Repository;

use Doctrine\ORM\EntityRepository;

class ProductRepository extends EntityRepository
{
	public function findById($id)
	{
		return $this->getEntityManager()
					->createQuery('SELECT * FROM Recipe WHERE id = ' . $id)
					->getResult();
	}
}