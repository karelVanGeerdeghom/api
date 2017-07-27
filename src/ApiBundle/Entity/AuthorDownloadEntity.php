<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use ApiBundle\Entity\DownloadEntity;

/**
 * AuthorDownloadEntity
 *
 * @ORM\Table(name="Download")
 * @ORM\Entity
 */
class AuthorDownloadEntity extends DownloadEntity {}