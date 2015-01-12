<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Allocations
 *
 * @ORM\Table(name="allocation_data")
 * @ORM\Entity
 */
class AllocationData {

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
     * @ORM\Column(name="individualperformances", type="string", length=100, nullable=false)
     * 
     */
    private $individualperformances;

    /**
     * @var bool
     * 
     * @ORM\Column(name="belongs_to_budget",type="boolean", nullable=false)
     * 
     */
    private $belongs_to_budget;

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
     * Set belongs_to_budget
     *
     * @param float $costpergrp
     * @return AllocationData
     */
    public function setBelongsToBudget($belongs_to_budget) {
        $this->belongs_to_budget = $belongs_to_budget;

        return $this;
    }

    /**
     * Get belongs_to_budget
     *
     * @return float 
     */
    public function getBelongsToBudget() {
        return $this->belongs_to_budget;
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
}
