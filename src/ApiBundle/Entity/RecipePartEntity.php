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
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\RecipePartDirectionsEntity", mappedBy="customerrecipepart", cascade={"persist"})
     * @ORM\OrderBy({"sortorder" = "ASC"})
     */
    private $recipepartdirections;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recipepartdirections = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

