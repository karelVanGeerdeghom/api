<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DirectionProductEntity
 *
 * @ORM\Table(name="RecipeDirections")
 * @ORM\Entity
 */
class DirectionProductEntity
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
     * @ORM\Column(name="Productgroup_id", type="integer", nullable=true)
     */
    private $productgroupId;

    /**
     * @var integer
     *
     * @ORM\Column(name="component_recipe", type="integer", nullable=true)
     */
    private $componentRecipe;

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
     * @var \ApiBundle\Entity\ProductEntity
     *
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\ProductEntity", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Recipe_id", referencedColumnName="id")
     * })
     */
    private $product;

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

