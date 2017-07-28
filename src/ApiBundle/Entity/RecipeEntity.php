<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RecipeEntity
 *
 * @ORM\Table(name="Customerrecipe")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\RecipeEntityRepository")
 */
class RecipeEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Brand_id", type="integer", nullable=false)
     */
    private $brandId;

    /**
     * @var integer
     *
     * @ORM\Column(name="title_tid", type="integer", nullable=false)
     */
    private $titleTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="assembly_tid", type="integer", nullable=false)
     */
    private $assemblyTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="dosage_tid", type="integer", nullable=false)
     */
    private $dosageTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="url_tid", type="integer", nullable=true)
     */
    private $urlTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="seo_title_tid", type="integer", nullable=true)
     */
    private $seoTitleTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="seo_description_tid", type="integer", nullable=true)
     */
    private $seoDescriptionTid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="premium", type="boolean", nullable=true)
     */
    private $premium;

    /**
     * @var boolean
     *
     * @ORM\Column(name="new", type="boolean", nullable=true)
     */
    private $new;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dietaryneed_vegan", type="boolean", nullable=true)
     */
    private $dietaryneedVegan;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dietaryneed_reduced_in_sugar", type="boolean", nullable=true)
     */
    private $dietaryneedReducedInSugar;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dietaryneed_nut_free", type="boolean", nullable=true)
     */
    private $dietaryneedNutFree;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dietaryneed_dairy_lactose_free", type="boolean", nullable=true)
     */
    private $dietaryneedDairyLactoseFree;

    /**
     * @var boolean
     *
     * @ORM\Column(name="dietaryneed_gluten_free", type="boolean", nullable=true)
     */
    private $dietaryneedGlutenFree;

    /**
     * @var integer
     *
     * @ORM\Column(name="level", type="integer", nullable=true)
     */
    private $level;

    /**
     * @var integer
     *
     * @ORM\Column(name="web_id", type="integer", nullable=true)
     */
    private $webId;

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
     * @ORM\OneToMany(targetEntity="ApiBundle\Entity\RecipePartEntity", mappedBy="customerrecipe", cascade={"persist"})
     */
    private $customerrecipepart;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->customerrecipepart = new \Doctrine\Common\Collections\ArrayCollection();
    }

}
