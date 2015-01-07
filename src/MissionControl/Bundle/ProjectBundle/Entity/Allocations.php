<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Allocations
 *
 * @ORM\Table(name="allocations", indexes={@ORM\Index(name="fk_allocations_results1_idx", columns={"result"})})
 * @ORM\Entity
 */
class Allocations
{
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
     * @var \MissionControl\Bundle\ProjectBundle\Entity\Results
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\Results")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="result", referencedColumnName="result_id")
     * })
     */
    private $result;



    /**
     * Set costpergrp
     *
     * @param float $costpergrp
     * @return Allocations
     */
    public function setCostpergrp($costpergrp)
    {
        $this->costpergrp = $costpergrp;

        return $this;
    }

    /**
     * Get costpergrp
     *
     * @return float 
     */
    public function getCostpergrp()
    {
        return $this->costpergrp;
    }

    /**
     * Set grp
     *
     * @param float $grp
     * @return Allocations
     */
    public function setGrp($grp)
    {
        $this->grp = $grp;

        return $this;
    }

    /**
     * Get grp
     *
     * @return float 
     */
    public function getGrp()
    {
        return $this->grp;
    }

    /**
     * Get allocationId
     *
     * @return integer 
     */
    public function getAllocationId()
    {
        return $this->allocationId;
    }

    /**
     * Set result
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\Results $result
     * @return Allocations
     */
    public function setResult(\MissionControl\Bundle\ProjectBundle\Entity\Results $result = null)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\Results 
     */
    public function getResult()
    {
        return $this->result;
    }
}
