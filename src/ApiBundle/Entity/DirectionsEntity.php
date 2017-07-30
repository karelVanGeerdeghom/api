<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DirectionsEntity
 *
 * @ORM\Table(name="Directions")
 * @ORM\Entity
 */
class DirectionsEntity
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
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\RecipePartDirectionsEntity", mappedBy="directions", cascade={"persist"})
     */
    private $recipepartdirections;

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
        $this->recipepartdirections = new \Doctrine\Common\Collections\ArrayCollection();
        $this->ingredient = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

