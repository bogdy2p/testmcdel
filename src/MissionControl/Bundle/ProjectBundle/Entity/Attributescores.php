<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Attributescores
 *
 * @ORM\Table(name="attributescores")
 * @ORM\Entity
 */
class Attributescores
{
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
     * Set attributescoreValue
     *
     * @param float $attributescoreValue
     * @return Attributescores
     */
    public function setAttributescoreValue($attributescoreValue)
    {
        $this->attributescoreValue = $attributescoreValue;

        return $this;
    }

    /**
     * Get attributescoreValue
     *
     * @return float 
     */
    public function getAttributescoreValue()
    {
        return $this->attributescoreValue;
    }

    /**
     * Get attributescoreId
     *
     * @return integer 
     */
    public function getAttributescoreId()
    {
        return $this->attributescoreId;
    }
}
