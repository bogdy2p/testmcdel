<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * BudgetTotal
 *
 * @ORM\Table(name="budget_total", indexes={@ORM\Index(name="fk_budgetallocationstotal_allocations1_idx", columns={"allocation"})})
 * @ORM\Entity
 */
class BudgetTotal
{
    /**
     * @var string
     *
     * @ORM\Column(name="touchpointame", type="string", length=255, nullable=true)
     */
    private $touchpointame;

    /**
     * @var integer
     *
     * @ORM\Column(name="total_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $totalId;

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
     * Set touchpointame
     *
     * @param string $touchpointame
     * @return BudgetTotal
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
     * Get totalId
     *
     * @return integer 
     */
    public function getTotalId()
    {
        return $this->totalId;
    }

    /**
     * Set allocation
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\Allocations $allocation
     * @return BudgetTotal
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
