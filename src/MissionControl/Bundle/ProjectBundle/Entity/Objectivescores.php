<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objectivescores
 *
 * @ORM\Table(name="objectivescores")
 * @ORM\Entity
 */
class Objectivescores
{
    /**
     * @var float
     *
     * @ORM\Column(name="objectivescore_value", type="float", precision=10, scale=0, nullable=true)
     */
    private $objectivescoreValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="objectivescore_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $objectivescoreId;



    /**
     * Set objectivescoreValue
     *
     * @param float $objectivescoreValue
     * @return Objectivescores
     */
    public function setObjectivescoreValue($objectivescoreValue)
    {
        $this->objectivescoreValue = $objectivescoreValue;

        return $this;
    }

    /**
     * Get objectivescoreValue
     *
     * @return float 
     */
    public function getObjectivescoreValue()
    {
        return $this->objectivescoreValue;
    }

    /**
     * Get objectivescoreId
     *
     * @return integer 
     */
    public function getObjectivescoreId()
    {
        return $this->objectivescoreId;
    }
}
