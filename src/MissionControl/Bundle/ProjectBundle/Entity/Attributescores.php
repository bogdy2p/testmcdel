<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attributescores
 *
 * @ORM\Table(name="attributescores")
 * @ORM\Entity
 */
class Attributescores {

    /**
     * @var float
     *
     * @ORM\Column(name="attributescore_value", type="float", precision=10, scale=0, nullable=true)
     */
    private $attributescoreValue;

    /**
     * @var integer
     *
     * @ORM\Column(name="attributescore_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $attributescoreId;

    /**
     * @var integer
     *
     * @ORM\Column(name="touchpoint_id", type="integer")
     */
    private $touchpointId;

    /**
     * Set touchpointId
     *
     * @param float $touchpointId
     * @return Objectivescores
     */
    public function setTouchpointId($touchpointId) {
        $this->touchpointId = $touchpointId;

        return $this;
    }

    /**
     * Get touchpointId
     *
     * @return float 
     */
    public function getTouchpointId() {
        return $this->touchpointId;
    }

    /**
     * Set attributescoreValue
     *
     * @param float $attributescoreValue
     * @return Attributescores
     */
    public function setAttributescoreValue($attributescoreValue) {
        $this->attributescoreValue = $attributescoreValue;

        return $this;
    }

    /**
     * Get attributescoreValue
     *
     * @return float 
     */
    public function getAttributescoreValue() {
        return $this->attributescoreValue;
    }

    /**
     * Get attributescoreId
     *
     * @return integer 
     */
    public function getAttributescoreId() {
        return $this->attributescoreId;
    }

}
