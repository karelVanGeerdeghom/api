<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecipePartDirectionEntity
 *
 * @ORM\Table(name="CustomerrecipepartDirections")
 * @ORM\Entity
 */
class RecipePartDirectionEntity
{
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
     * @var \ApiBundle\Entity\RecipePartEntity
     *
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\RecipePartEntity", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Customerrecipepart_id", referencedColumnName="id")
     * })
     */
    private $customerrecipepart;

    /**
     * @var \ApiBundle\Entity\DirectionEntity
     *
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\DirectionEntity", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Directions_id", referencedColumnName="id")
     * })
     */
    private $direction;


}

