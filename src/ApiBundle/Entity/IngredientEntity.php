<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * IngredientEntity
 *
 * @ORM\Table(name="Ingredient")
 * @ORM\Entity
 */
class IngredientEntity
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
     * @ORM\Column(name="url_tid", type="integer", nullable=true)
     */
    private $urlTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

