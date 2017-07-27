<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TestimonialEntity
 *
 * @ORM\Table(name="Testimonial")
 * @ORM\Entity
 */
class TestimonialEntity
{
    /**
     * @var integer
     *
     * @ORM\Column(name="Brand_id", type="integer", nullable=false)
     */
    private $brandId;

    /**
     * @var integer
     *
     * @ORM\Column(name="Country_id", type="integer", nullable=false)
     */
    private $countryId;

    /**
     * @var integer
     *
     * @ORM\Column(name="text_tid", type="integer", nullable=false)
     */
    private $textTid;

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
     * @ORM\ManyToMany(targetEntity="ApiBundle\Entity\AuthorEntity", inversedBy="testimonial", fetch="EAGER")
     * @ORM\JoinTable(name="TestimonialAuthor",
     *   joinColumns={
     *     @ORM\JoinColumn(name="Testimonial_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="Author_id", referencedColumnName="id")
     *   }
     * )
     */
    private $author;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->author = new \Doctrine\Common\Collections\ArrayCollection();
    }

}

