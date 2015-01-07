<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Individualperformances
 *
 * @ORM\Table(name="individualperformances")
 * @ORM\Entity
 */
class Individualperformances
{
    /**
     * @var float
     *
     * @ORM\Column(name="individualperformance_value", type="float", precision=10, scale=0, nullable=true)
     */
    private $individualperformanceValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="individualperformance_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $individualperformanceId;



    /**
     * Set individualperformanceValue
     *
     * @param float $individualperformanceValue
     * @return Individualperformances
     */
    public function setIndividualperformanceValue($individualperformanceValue)
    {
        $this->individualperformanceValue = $individualperformanceValue;

        return $this;
    }

    /**
     * Get individualperformanceValue
     *
     * @return float 
     */
    public function getIndividualperformanceValue()
    {
        return $this->individualperformanceValue;
    }

    /**
     * Get individualperformanceId
     *
     * @return integer 
     */
    public function getIndividualperformanceId()
    {
        return $this->individualperformanceId;
    }
}
