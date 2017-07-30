<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecipePartEntity
 *
 * @ORM\Table(name="Customerrecipepart")
 * @ORM\Entity
 */
class RecipePartEntity
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
     * @ORM\Column(name="web_id", type="integer", nullable=true)
     */
    private $webId;

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
     * @var \ApiBundle\Entity\RecipeEntity
     *
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\RecipeEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Customerrecipe_id", referencedColumnName="id")
     * })
     */
    private $customerrecipe;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ApiBundle\Entity\DirectionsEntity", inversedBy="customerrecipepart", fetch="EAGER")
     * @ORM\JoinTable(name="CustomerrecipepartDirections",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Customerrecipepart_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Directions_id", referencedColumnName="id")
     *   }
     * )
     */
    private $directions;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->directions = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

