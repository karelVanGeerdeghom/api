<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DirectionIngredientEntity
 *
 * @ORM\Table(name="DirectionsIngredient")
 * @ORM\Entity
 */
class DirectionIngredientEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="quantity", type="string", length=255, nullable=false)
     */
    private $quantity;

    /**
     * @var integer
     *
     * @ORM\Column(name="sortorder", type="integer", nullable=true)
     */
    private $sortorder;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \ApiBundle\Entity\DirectionEntity
     *
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\DirectionEntity", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Directions_id", referencedColumnName="id")
     * })
     */
    private $directions;

    /**
     * @var \ApiBundle\Entity\IngredientEntity
     *
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\IngredientEntity", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Ingredient_id", referencedColumnName="id")
     * })
     */
    private $ingredient;

    /**
     * @var \ApiBundle\Entity\QuantitylabelEntity
     *
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\QuantitylabelEntity", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Quantitylabel_id", referencedColumnName="id")
     * })
     */
    private $quantitylabel;

}

