<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DirectionEntity
 *
 * @ORM\Table(name="Directions")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\DirectionEntityRepository")
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
    private $recipepartdirection;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\DirectionIngredientEntity", mappedBy="directions", cascade={"persist"})
     * @ORM\OrderBy({"sortorder" = "ASC"})
     */
    private $directioningredient;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\DirectionProductEntity", mappedBy="directions", cascade={"persist"})
     * @ORM\OrderBy({"sortorder" = "ASC"})
     */
    private $directionproduct;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recipepartdirection = new \Doctrine\Common\Collections\ArrayCollection();
        $this->directioningredient = new \Doctrine\Common\Collections\ArrayCollection();
        $this->directionproduct = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

