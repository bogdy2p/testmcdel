<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Touchpointallocations
 *
 * @ORM\Table(name="touchpointallocations")
 * @ORM\Entity
 */
class Touchpointallocations
{
    /**
     * @var string
     *
     * @ORM\Column(name="touchpointname", type="string", length=255, nullable=true)
     */
    private $touchpointname;

    /**
     * @var integer
     *
     * @ORM\Column(name="touchpointallocation_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $touchpointallocationId;

    /**
     * @var \MissionControl\Bundle\ProjectBundle\Entity\Allocations
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\Allocations")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="allocation", referencedColumnName="allocation_id")
     * })
     */
    private $allocation;

/**
     * @var integer
     *
     * @ORM\Column(name="budget_id", type="string", nullable=false)
     */
    private $budgetId;

    /**
     * Set BudgetId
     *
     * @param string $BudgetId
     * @return Objectives
     */
    public function setBudgetId($budgetId) {
        $this->budgetId = $budgetId;

        return $this;
    }

    /**
     * Get BudgetId
     *
     * @return string 
     */
    public function getProjectId() {
        return $this->budgetId;
    }

    /**
     * Set touchpointname
     *
     * @param string $touchpointname
     * @return Touchpointallocations
     */
    public function setTouchpointname($touchpointname)
    {
        $this->touchpointname = $touchpointname;

        return $this;
    }

    /**
     * Get touchpointname
     *
     * @return string 
     */
    public function getTouchpointname()
    {
        return $this->touchpointname;
    }

    /**
     * Get touchpointallocationId
     *
     * @return integer 
     */
    public function getTouchpointallocationId()
    {
        return $this->touchpointallocationId;
    }

    /**
     * Set allocation
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\Allocations $allocation
     * @return Touchpointallocations
     */
    public function setAllocation(\MissionControl\Bundle\ProjectBundle\Entity\Allocations $allocation = null)
    {
        $this->allocation = $allocation;

        return $this;
    }

    /**
     * Get allocation
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\Allocations 
     */
    public function getAllocation()
    {
        return $this->allocation;
    }
}
