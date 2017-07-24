<?php

namespace ApiBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DownloadEntity
 *
 * @ORM\Table(name="Download")
 * @ORM\Entity
 */
class DownloadEntity
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
     * @ORM\Column(name="file_tid", type="integer", nullable=false)
     */
    private $fileTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="info_tid", type="integer", nullable=false)
     */
    private $infoTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="label_tid", type="integer", nullable=true)
     */
    private $labelTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="offset_left_tid", type="integer", nullable=true)
     */
    private $offsetLeftTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="offset_top_tid", type="integer", nullable=true)
     */
    private $offsetTopTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="preview_tid", type="integer", nullable=false)
     */
    private $previewTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="specs_tid", type="integer", nullable=true)
     */
    private $specsTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="title_tid", type="integer", nullable=false)
     */
    private $titleTid;

    /**
     * @var integer
     *
     * @ORM\Column(name="filetype_id", type="integer", nullable=true)
     */
    private $filetypeId;

    /**
     * @var string
     *
     * @ORM\Column(name="alignment_hor", type="string", length=50, nullable=true)
     */
    private $alignmentHor;

    /**
     * @var string
     *
     * @ORM\Column(name="alignment_ver", type="string", length=50, nullable=true)
     */
    private $alignmentVer;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;


}

