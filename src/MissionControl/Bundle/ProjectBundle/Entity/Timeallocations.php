<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Timeallocations
 *
 * @ORM\Table(name="timeallocations", indexes={@ORM\Index(name="fk_timeallocations_timeallocation_allocatedtouchpoints1_idx", columns={"allocatedtouchpoints"}), @ORM\Index(name="fk_timeallocations_timeallocationstotal1", columns={"total"})})
 * @ORM\Entity
 */
class Timeallocations
{
    /**
     * @var integer
     *
     * @ORM\Column(name="timeallocation_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $timeallocationId;

    /**
     * @var \MissionControl\Bundle\ProjectBundle\Entity\TimeAllocatedtouchpoints
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\TimeAllocatedtouchpoints")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="allocatedtouchpoints", referencedColumnName="allocatedtouchpoint_id")
     * })
     */
    private $allocatedtouchpoints;

    /**
     * @var \MissionControl\Bundle\ProjectBundle\Entity\TimeTotal
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\TimeTotal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="total", referencedColumnName="total_id")
     * })
     */
    private $total;



    /**
     * Get timeallocationId
     *
     * @return integer 
     */
    public function getTimeallocationId()
    {
        return $this->timeallocationId;
    }

    /**
     * Set allocatedtouchpoints
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\TimeAllocatedtouchpoints $allocatedtouchpoints
     * @return Timeallocations
     */
    public function setAllocatedtouchpoints(\MissionControl\Bundle\ProjectBundle\Entity\TimeAllocatedtouchpoints $allocatedtouchpoints = null)
    {
        $this->allocatedtouchpoints = $allocatedtouchpoints;

        return $this;
    }

    /**
     * Get allocatedtouchpoints
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\TimeAllocatedtouchpoints 
     */
    public function getAllocatedtouchpoints()
    {
        return $this->allocatedtouchpoints;
    }

    /**
     * Set total
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\TimeTotal $total
     * @return Timeallocations
     */
    public function setTotal(\MissionControl\Bundle\ProjectBundle\Entity\TimeTotal $total = null)
    {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\TimeTotal 
     */
    public function getTotal()
    {
        return $this->total;
    }
}
