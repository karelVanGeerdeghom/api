<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use ApiBundle\Entity\AuthorEntity;

/**
 * RecipeAuthorEntity
 *
 * @ORM\Table(name="Author")
 * @ORM\Entity
 */
class RecipeAuthorEntity extends AuthorEntity {}