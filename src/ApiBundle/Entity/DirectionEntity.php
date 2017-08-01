<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DirectionEntity
 *
 * @ORM\Table(name="Directions")
 * @ORM\Entity
 */
class DirectionEntity
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
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\RecipePartDirectionEntity", mappedBy="direction", cascade={"persist"})
     */
    private $recipepartDirection;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recipepartDirection = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

