<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ColorEntity
 *
 * @ORM\Table(name="Color")
 * @ORM\Entity
 */
class ColorEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="commercial_tid", type="integer", nullable=true)
     */
    private $titleTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="internal_tid", type="integer", nullable=true)
     */
    private $internalTid;

    /**
     * @var string
     *
     * @ORM\Column(name="hex_light", type="string", length=7, nullable=true)
     */
    private $hexLight;

    /**
     * @var string
     *
     * @ORM\Column(name="hex_dark", type="string", length=7, nullable=true)
     */
    private $hexDark;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

