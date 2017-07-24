<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FielddescriptionEntity
 *
 * @ORM\Table(name="Fielddescription")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\FielddescriptionEntityRepository")
 */
class FielddescriptionEntity
{
    /**
     * @var string
     *
     * @ORM\Column(name="Tablename", type="string", length=255, nullable=false)
     */
    private $tablename;

    /**
     * @var string
     *
     * @ORM\Column(name="Fieldname", type="string", length=255, nullable=false)
     */
    private $fieldname;

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

