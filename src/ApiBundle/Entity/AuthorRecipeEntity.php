<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use ApiBundle\Entity\AuthorEntity;

/**
 * AuthorRecipeEntity
 *
 * @ORM\Table(name="Author")
 * @ORM\Entity
 */
class AuthorRecipeEntity extends AuthorEntity {}