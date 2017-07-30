<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use ApiBundle\Entity\DownloadEntity;

/**
 * ApplicationDownloadEntity
 *
 * @ORM\Table(name="Download")
 * @ORM\Entity
 */
class ApplicationDownloadEntity extends DownloadEntity {}