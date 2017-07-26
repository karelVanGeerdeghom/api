<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ShapeEntity
 *
 * @ORM\Table(name="Shape")
 * @ORM\Entity
 */
class ShapeEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="description_tid", type="integer", nullable=false)
     */
    private $descriptionTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

