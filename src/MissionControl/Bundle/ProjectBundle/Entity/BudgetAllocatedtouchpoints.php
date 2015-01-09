<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BudgetAllocatedtouchpoints
 *
 * @ORM\Table(name="budget_allocatedtouchpoints")
 * @ORM\Entity
 */
class BudgetAllocatedtouchpoints
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
     * @var \MissionControl\Bundle\ProjectBundle\Entity\Touchpointallocations
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\Touchpointallocations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="touchpointallocation", referencedColumnName="touchpointallocation_id")
     * })
     */
    private $touchpointallocation;



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
     * Set touchpointallocation
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\Touchpointallocations $touchpointallocation
     * @return BudgetAllocatedtouchpoints
     */
    public function setTouchpointallocation(\MissionControl\Bundle\ProjectBundle\Entity\Touchpointallocations $touchpointallocation = null)
    {
        $this->touchpointallocation = $touchpointallocation;

        return $this;
    }

    /**
     * Get touchpointallocation
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\Touchpointallocations 
     */
    public function getTouchpointallocation()
    {
        return $this->touchpointallocation;
    }
}
