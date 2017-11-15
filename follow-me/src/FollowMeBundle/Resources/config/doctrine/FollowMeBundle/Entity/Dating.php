<?php

namespace FollowMeBundle\Entity;


class Dating
{
    /**
     * @var string
     *
     * @ORM\Column(name="dating_title", type="string", length=64, nullable=false)
     */
    private $datingTitle;

    /**
     * @var string
     *
     * @ORM\Column(name="dating_description", type="text", length=65535, nullable=false)
     */
    private $datingDescription;

    /**
     * @var integer
     *
     * @ORM\Column(name="dating_start", type="integer", nullable=false)
     */
    private $datingStart;

    /**
     * @var integer
     *
     * @ORM\Column(name="dating_end", type="integer", nullable=false)
     */
    private $datingEnd;

    /**
     * @var float
     *
     * @ORM\Column(name="dating_lat", type="float", precision=10, scale=0, nullable=true)
     */
    private $datingLat;

    /**
     * @var float
     *
     * @ORM\Column(name="dating_lng", type="float", precision=10, scale=0, nullable=true)
     */
    private $datingLng;

    /**
     * @var string
     *
     * @ORM\Column(name="dating_link_href", type="string", length=4048, nullable=true)
     */
    private $datingLinkHref;

    /**
     * @var string
     *
     * @ORM\Column(name="dating_link_title", type="string", length=4048, nullable=true)
     */
    private $datingLinkTitle;

    /**
     * @var integer
     *
     * @ORM\Column(name="dating_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $datingId;

    /**
     * @var \FollowMeBundle\Entity\User
     *
     * @ORM\ManyToOne(targetEntity="FollowMeBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="user_id", referencedColumnName="user_id")
     * })
     */
    private $user;


}

