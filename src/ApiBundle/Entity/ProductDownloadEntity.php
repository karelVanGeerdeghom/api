<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use ApiBundle\Entity\DownloadEntity;

/**
 * ProductDownloadEntity
 *
 * @ORM\Table(name="Download")
 * @ORM\Entity
 */
class ProductDownloadEntity extends DownloadEntity {}