<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthorEntity
 *
 * @ORM\Table(name="Author")
 * @ORM\Entity
 */
class AuthorEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="description_tid", type="integer", nullable=true)
     */
    private $descriptionTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="function_tid", type="integer", nullable=true)
     */
    private $functionTid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

