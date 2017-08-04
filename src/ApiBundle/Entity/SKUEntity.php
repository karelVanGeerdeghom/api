<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SKUEntity
 *
 * @ORM\Table(name="Product")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\SKUEntityRepository")
 */
class SKUEntity
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
     * @ORM\Column(name="cluster_tid", type="integer", nullable=true)
     */
    private $clusterTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="GPC_info_tid", type="integer", nullable=true)
     */
    private $gpcInfoTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="SAP_tid", type="integer", nullable=true)
     */
    private $sapTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="SAP2_tid", type="integer", nullable=true)
     */
    private $sap2Tid;

    /**
     * @var string
     *
     * @ORM\Column(name="packaging_type", type="string", length=50, nullable=true)
     */
    private $packagingType;

    /**
     * @var string
     *
     * @ORM\Column(name="SAP_code", type="string", length=255, nullable=true)
     */
    private $sapCode;

    /**
     * @var string
     *
     * @ORM\Column(name="shelflife", type="string", length=255, nullable=true)
     */
    private $shelflife;

    /**
     * @var string
     *
     * @ORM\Column(name="sku", type="string", length=255, nullable=true)
     */
    private $sku;

    /**
     * @var integer
     *
     * @ORM\Column(name="sortorder", type="integer", nullable=true)
     */
    private $sortorder;

    /**
     * @var boolean
     *
     * @ORM\Column(name="halal", type="boolean", nullable=true)
     */
    private $halal;

    /**
     * @var string
     *
     * @ORM\Column(name="kosher", type="string", length=255, nullable=true)
     */
    private $kosher;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \ApiBundle\Entity\ProductEntity
     *
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\ProductEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Recipe_id", referencedColumnName="id")
     * })
     */
    private $recipe;

    /**
     * @var \ApiBundle\Entity\PackagingEntity
     *
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\PackagingEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Packaging_id", referencedColumnName="id")
     * })
     */
    private $packaging;

    /**
     * @var \ApiBundle\Entity\ShapeEntity
     *
     * @ORM\ManyToOne(targetEntity="ApiBundle\Entity\ShapeEntity")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="Shape_id", referencedColumnName="id")
     * })
     */
    private $shape;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ApiBundle\Entity\DownloadSKUEntity", inversedBy="product", fetch="EAGER")
     * @ORM\JoinTable(name="ProductDownload",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Product_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Download_id", referencedColumnName="id")
     *   }
     * )
     */
    private $download;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->download = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

