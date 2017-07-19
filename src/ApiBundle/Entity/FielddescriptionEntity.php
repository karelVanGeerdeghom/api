<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use ApiBundle\Repository\ColumntranslationEntityRepository;

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
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

