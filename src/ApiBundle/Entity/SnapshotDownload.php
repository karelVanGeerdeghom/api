<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SnapshotDownload
 *
 * @ORM\Table(name="Snapshot_InactiveCultureAppDownload")
 * @ORM\Entity
 */
class SnapshotDownload
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=true)
     */
    private $id;

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
     * @ORM\Column(name="App_id", type="integer", nullable=true)
     */
    private $appId;

    /**
     * @var integer
     *
     * @ORM\Column(name="index", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $index;


}

