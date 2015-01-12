<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Allocations
 *
 * @ORM\Table(name="budget_allocation_data")
 * @ORM\Entity
 */
class BudgetAllocationData {

    /**
     * @var float
     *
     * @ORM\Column(name="costpergrp", type="float", precision=10, scale=0, nullable=true)
     */
    private $costpergrp;

    /**
     * @var float
     *
     * @ORM\Column(name="grp", type="float", precision=10, scale=0, nullable=true)
     */
    private $grp;

    /**
     * @var integer
     *
     * @ORM\Column(name="allocation_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $allocationId;

    /**
     * @var float
     *
     * @ORM\Column(name="globalperformance", type="float", precision=10, scale=0, nullable=true)
     */
    private $globalperformance;

    /**
     * @var float
     *
     * @ORM\Column(name="reach", type="float", precision=10, scale=0, nullable=true)
     */
    private $reach;

    /**
     * @var string
     * 
     * @ORM\Column(name="individualperformances", type="string", length=255, nullable=false)
     * 
     */
    private $individualperformances;

    /**
     * @var string
     * 
     * @ORM\Column(name="touchpointname", type="string", length=255, nullable=false)
     * 
     */
    private $touchpointname;

    /**
     * @var bool
     * 
     * @ORM\Column(name="belongs_to_project",type="string", length=36, nullable=false)
     * 
     */
    private $belongs_to_project;

    /**
     * @var bool
     * 
     * @ORM\Column(name="is_total", type="boolean", nullable=false)
     * 
     */
    private $is_total;

    /**
     * Set is_total
     *
     * @param float $costpergrp
     * @return AllocationData
     */
    public function setIsTotal($is_total) {
        $this->is_total = $is_total;

        return $this;
    }

    /**
     * Get is_total
     *
     * @return float 
     */
    public function getIsTotal() {
        return $this->is_total;
    }

    /**
     * Set belongs_to_project
     *
     * @param float $costpergrp
     * @return AllocationData
     */
    public function setBelongsToProject($belongs_to_project) {
        $this->belongs_to_project = $belongs_to_project;

        return $this;
    }

    /**
     * Get belongs_to_project
     *
     * @return float 
     */
    public function getBelongsToProject() {
        return $this->belongs_to_project;
    }

    /**
     * Set costpergrp
     *
     * @param float $costpergrp
     * @return AllocationData
     */
    public function setCostpergrp($costpergrp) {
        $this->costpergrp = $costpergrp;

        return $this;
    }

    /**
     * Get costpergrp
     *
     * @return float 
     */
    public function getCostpergrp() {
        return $this->costpergrp;
    }

    /**
     * Set grp
     *
     * @param float $grp
     * @return Allocations
     */
    public function setGrp($grp) {
        $this->grp = $grp;

        return $this;
    }

    /**
     * Get grp
     *
     * @return float 
     */
    public function getGrp() {
        return $this->grp;
    }

    /**
     * Get allocationId
     *
     * @return integer 
     */
    public function getAllocationId() {
        return $this->allocationId;
    }

    /**
     * Set globalperformance
     *
     * @param float $globalperformance
     * @return AllocationData
     */
    public function setGlobalPerformance($globalperformance) {
        $this->globalperformance = $globalperformance;

        return $this;
    }

    /**
     * Get globalperformance
     *
     * @return float 
     */
    public function getGlobalPerformance() {
        return $this->globalperformance;
    }

    /**
     * Set reach
     *
     * @param float $reach
     * @return AllocationData
     */
    public function setReach($reach) {
        $this->reach = $reach;

        return $this;
    }

    /**
     * Get reach
     *
     * @return float 
     */
    public function getReach() {
        return $this->reach;
    }

    /**
     * Set individualperformances
     *
     * @param float $individualperformances
     * @return AllocationData
     */
    public function setIndividualPerformances($individualperformances) {
        $this->individualperformances = $individualperformances;

        return $this;
    }

    /**
     * Get individualperformances
     *
     * @return float 
     */
    public function getIndividualPerformances() {
        return $this->individualperformances;
    }
/**
     * Set touchpointname
     *
     * @param string $touchpointname
     * @return AllocationData
     */
    public function setTouchpointName($touchpointname) {
        $this->touchpointname = $touchpointname;

        return $this;
    }

    /**
     * Get touchpointname
     *
     * @return string 
     */
    public function getTouchpointName() {
        return $this->touchpointname;
    }
}
