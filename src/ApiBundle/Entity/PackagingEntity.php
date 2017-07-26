<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PackagingEntity
 *
 * @ORM\Table(name="Packaging")
 * @ORM\Entity
 */
class PackagingEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="1_1_amount_tid", type="integer", nullable=true)
     */
    private $oneOneAmountTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="1_1_type_tid", type="integer", nullable=true)
     */
    private $oneOneTypeTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="1_2_amount_tid", type="integer", nullable=true)
     */
    private $oneTwoAmountTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="1_2_type_tid", type="integer", nullable=true)
     */
    private $oneTwoTypeTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="2_1_amount_tid", type="integer", nullable=true)
     */
    private $twoOneAmountTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="2_1_type_tid", type="integer", nullable=true)
     */
    private $twoOneTypeTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="2_2_amount_tid", type="integer", nullable=true)
     */
    private $twoTwoAmountTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="2_2_type_tid", type="integer", nullable=true)
     */
    private $twoTwoTypeTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="3_1_amount_tid", type="integer", nullable=true)
     */
    private $threeOneAmountTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="3_1_type_tid", type="integer", nullable=true)
     */
    private $threeOneTypeTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="3_2_amount_tid", type="integer", nullable=true)
     */
    private $threeTwoAmountTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="3_2_type_tid", type="integer", nullable=true)
     */
    private $threeTwoTypeTid;

    /**
     * @var string
     *
     * @ORM\Column(name="packagingid", type="string", length=8, nullable=true)
     */
    private $packagingid;

    /**
     * @var boolean
     *
     * @ORM\Column(name="unique_packaging", type="boolean", nullable=true)
     */
    private $uniquePackaging;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

