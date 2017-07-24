<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AuthorEntity
 *
 * @ORM\Table(name="Author")
 * @ORM\Entity(repositoryClass="ApiBundle\Repository\AuthorEntityRepository")
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

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="ApiBundle\Entity\DownloadEntity", inversedBy="author", fetch="EAGER")
     * @ORM\JoinTable(name="authordownload",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Author_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Download_id", referencedColumnName="id")
     *   }
     * )
     */
    private $download;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->download = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

