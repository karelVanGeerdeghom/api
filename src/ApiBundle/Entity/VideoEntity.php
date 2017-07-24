<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use ApiBundle\Repository\ProductEntityRepository;

/**
 * VideoEntity
 *
 * @ORM\Table(name="Video")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\VideoEntityRepository")
 */
class VideoEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="title_tid", type="integer", nullable=false)
     */
    private $titleTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="description_short_tid", type="integer", nullable=false)
     */
    private $descriptionShortTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="description_long_tid", type="integer", nullable=false)
     */
    private $descriptionLongTid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="premium", type="boolean", nullable=true)
     */
    private $premium;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

