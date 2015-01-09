<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Touchpointtimeallocation
 *
 * @ORM\Table(name="touchpointtimeallocation")
 * @ORM\Entity
 */
class Touchpointtimeallocation
{
    /**
     * @var string
     *
     * @ORM\Column(name="touchpointame", type="string", length=255, nullable=true)
     */
    private $touchpointame;

    /**
     * @var float
     *
     * @ORM\Column(name="reachfrequency", type="float", precision=10, scale=0, nullable=true)
     */
    private $reachfrequency;

    /**
     * @var integer
     *
     * @ORM\Column(name="touchpointtimeallocation_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $touchpointtimeallocationId;

    /**
     * @var \MissionControl\Bundle\ProjectBundle\Entity\Allocations
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\Allocations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="allocationbyperiod", referencedColumnName="allocation_id")
     * })
     */
    private $allocationbyperiod;



    /**
     * Set touchpointame
     *
     * @param string $touchpointame
     * @return Touchpointtimeallocation
     */
    public function setTouchpointame($touchpointame)
    {
        $this->touchpointame = $touchpointame;

        return $this;
    }

    /**
     * Get touchpointame
     *
     * @return string 
     */
    public function getTouchpointame()
    {
        return $this->touchpointame;
    }

    /**
     * Set reachfrequency
     *
     * @param float $reachfrequency
     * @return Touchpointtimeallocation
     */
    public function setReachfrequency($reachfrequency)
    {
        $this->reachfrequency = $reachfrequency;

        return $this;
    }

    /**
     * Get reachfrequency
     *
     * @return float 
     */
    public function getReachfrequency()
    {
        return $this->reachfrequency;
    }

    /**
     * Get touchpointtimeallocationId
     *
     * @return integer 
     */
    public function getTouchpointtimeallocationId()
    {
        return $this->touchpointtimeallocationId;
    }

    /**
     * Set allocationbyperiod
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\Allocations $allocationbyperiod
     * @return Touchpointtimeallocation
     */
    public function setAllocationbyperiod(\MissionControl\Bundle\ProjectBundle\Entity\Allocations $allocationbyperiod = null)
    {
        $this->allocationbyperiod = $allocationbyperiod;

        return $this;
    }

    /**
     * Get allocationbyperiod
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\Allocations 
     */
    public function getAllocationbyperiod()
    {
        return $this->allocationbyperiod;
    }
}
