<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IngredientEntity
 *
 * @ORM\Table(name="Quantitylabel")
 * @ORM\Entity
 */
class QuantitylabelEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="label_tid", type="integer", nullable=false)
     */
    private $labelTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

