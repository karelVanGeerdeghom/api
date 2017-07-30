<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecipePartDirectionsEntity
 *
 * @ORM\Table(name="CustomerrecipepartDirections")
 * @ORM\Entity
 */
class RecipePartDirectionsEntity
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
     * @var \ApiBundle\Entity\DirectionsEntity
     *
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\DirectionsEntity", fetch="EAGER")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Directions_id", referencedColumnName="id")
     * })
     */
    private $directions;


}

