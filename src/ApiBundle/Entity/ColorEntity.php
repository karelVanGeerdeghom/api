<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ColorEntity
 *
 * @ORM\Table(name="Color")
 * @ORM\Entity
 */
class ColorEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="commercial_tid", type="integer", nullable=true)
     */
    private $commercialTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="internal_tid", type="integer", nullable=true)
     */
    private $internalTid;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="added", type="datetime", nullable=true)
     */
    private $added;

    /**
     * @var integer
     *
     * @ORM\Column(name="added_user", type="integer", nullable=true)
     */
    private $addedUser;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated", type="datetime", nullable=true)
     */
    private $updated;

    /**
     * @var integer
     *
     * @ORM\Column(name="updated_user", type="integer", nullable=true)
     */
    private $updatedUser;

    /**
     * @var string
     *
     * @ORM\Column(name="hex_light", type="string", length=7, nullable=true)
     */
    private $hexLight;

    /**
     * @var string
     *
     * @ORM\Column(name="hex_dark", type="string", length=7, nullable=true)
     */
    private $hexDark;

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
     * @ORM\ManyToMany(targetEntity="ApiBundle\Entity\ProductEntity", mappedBy="color")
     */
    private $recipe;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->recipe = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

