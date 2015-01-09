<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Budgetallocations
 *
 * @ORM\Table(name="budgetallocations")
 * @ORM\Entity
 */
class Budgetallocations {

    /**
     * @var integer
     *
     * @ORM\Column(name="budgetallocation_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $budgetallocationId;

    /**
     * @var \MissionControl\Bundle\ProjectBundle\Entity\BudgetAllocatedtouchpoints
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\BudgetAllocatedtouchpoints")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="allocatedtouchpoints", referencedColumnName="allocatedtouchpoint_id")
     * })
     */
    private $allocatedtouchpoints;

    /**
     * @var \MissionControl\Bundle\ProjectBundle\Entity\BudgetTotal
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\BudgetTotal")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="total", referencedColumnName="total_id")
     * })
     */
    private $total;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_id", type="string", nullable=false)
     */
    private $projectId;

    /**
     * Set ProjectId
     *
     * @param string $projectId
     * @return Objectives
     */
    public function setProjectId($projectId) {
        $this->projectId = $projectId;

        return $this;
    }

    /**
     * Get ProjectId
     *
     * @return string 
     */
    public function getProjectId() {
        return $this->projectId;
    }

    /**
     * Get budgetallocationId
     *
     * @return integer 
     */
    public function getBudgetallocationId() {
        return $this->budgetallocationId;
    }

    /**
     * Set allocatedtouchpoints
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\BudgetAllocatedtouchpoints $allocatedtouchpoints
     * @return Budgetallocations
     */
    public function setAllocatedtouchpoints(\MissionControl\Bundle\ProjectBundle\Entity\BudgetAllocatedtouchpoints $allocatedtouchpoints = null) {
        $this->allocatedtouchpoints = $allocatedtouchpoints;

        return $this;
    }

    /**
     * Get allocatedtouchpoints
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\BudgetAllocatedtouchpoints 
     */
    public function getAllocatedtouchpoints() {
        return $this->allocatedtouchpoints;
    }

    /**
     * Set total
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\BudgetTotal $total
     * @return Budgetallocations
     */
    public function setTotal(\MissionControl\Bundle\ProjectBundle\Entity\BudgetTotal $total = null) {
        $this->total = $total;

        return $this;
    }

    /**
     * Get total
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\BudgetTotal 
     */
    public function getTotal() {
        return $this->total;
    }

}
