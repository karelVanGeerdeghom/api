<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use ApiBundle\Entity\DownloadEntity;

/**
 * RecipeDownloadEntity
 *
 * @ORM\Table(name="Download")
 * @ORM\Entity
 */
class RecipeDownloadEntity extends DownloadEntity {}