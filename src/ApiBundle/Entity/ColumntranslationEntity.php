<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use ApiBundle\Repository\ColumntranslationEntityRepository;

/**
 * ColumntranslationEntity
 *
 * @ORM\Table(name="Columntranslation")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\ColumntranslationEntityRepository")
 */
class ColumntranslationEntity
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
     * @ORM\Column(name="table", type="string", length=255, nullable=true)
     */
    private $table;

    /**
     * @var string
     *
     * @ORM\Column(name="column", type="string", length=255, nullable=true)
     */
    private $column;

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

