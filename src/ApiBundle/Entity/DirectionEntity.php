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
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\RecipePartDirectionEntity", mappedBy="directions", cascade={"persist"})
     */
    private $recipepartDirection;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ApiBundle\Entity\IngredientEntity", inversedBy="directions", fetch="EAGER")
     * @ORM\JoinTable(name="DirectionsIngredient",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Directions_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Ingredient_id", referencedColumnName="id")
     *   }
     * )
     */
    private $ingredient;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recipepartDirection = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ingredient = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

