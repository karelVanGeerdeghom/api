<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ItemTranslationEntity
 *
 * @ORM\Table(name="Itemtranslation")
 * @ORM\Entity
 */
class ItemTranslationEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="table", type="string", length=255, nullable=true)
     */
    private $table;

    /**
     * @var integer
     *
     * @ORM\Column(name="table_id", type="integer", nullable=true)
     */
    private $tableId;

    /**
     * @var integer
     *
     * @ORM\Column(name="Language_id", type="integer", nullable=true)
     */
    private $languageId;

    /**
     * @var integer
     *
     * @ORM\Column(name="Country_id", type="integer", nullable=true)
     */
    private $countryId;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

