<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TimeAllocatedtouchpoints
 *
 * @ORM\Table(name="time_allocatedtouchpoints")
 * @ORM\Entity
 */
class TimeAllocatedtouchpoints
{
    /**
     * @var integer
     *
     * @ORM\Column(name="allocatedtouchpoint_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $allocatedtouchpointId;

    /**
     * @var \MissionControl\Bundle\ProjectBundle\Entity\Touchpointtimeallocation
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\Touchpointtimeallocation")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="touchpointtimeallocation", referencedColumnName="touchpointtimeallocation_id")
     * })
     */
    private $touchpointtimeallocation;



    /**
     * Get allocatedtouchpointId
     *
     * @return integer 
     */
    public function getAllocatedtouchpointId()
    {
        return $this->allocatedtouchpointId;
    }

    /**
     * Set touchpointtimeallocation
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\Touchpointtimeallocation $touchpointtimeallocation
     * @return TimeAllocatedtouchpoints
     */
    public function setTouchpointtimeallocation(\MissionControl\Bundle\ProjectBundle\Entity\Touchpointtimeallocation $touchpointtimeallocation = null)
    {
        $this->touchpointtimeallocation = $touchpointtimeallocation;

        return $this;
    }

    /**
     * Get touchpointtimeallocation
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\Touchpointtimeallocation 
     */
    public function getTouchpointtimeallocation()
    {
        return $this->touchpointtimeallocation;
    }
}
