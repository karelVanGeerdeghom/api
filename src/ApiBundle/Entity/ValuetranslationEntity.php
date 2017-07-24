<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ValuetranslationEntity
 *
 * @ORM\Table(name="Valuetranslation")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\ValuetranslationEntityRepository")
 */
class ValuetranslationEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="App_id", type="integer", nullable=false)
     */
    private $appId;

    /**
     * @var string
     *
     * @ORM\Column(name="table", type="string", length=255, nullable=false)
     */
    private $table;

    /**
     * @var string
     *
     * @ORM\Column(name="column", type="string", length=255, nullable=false)
     */
    private $column;

    /**
     * @var string
     *
     * @ORM\Column(name="value", type="string", length=255, nullable=false)
     */
    private $value;

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

