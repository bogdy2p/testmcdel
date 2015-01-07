<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Results
 *
 * @ORM\Table(name="results", indexes={@ORM\Index(name="fk_results_individualperformances1_idx", columns={"individualperformance"})})
 * @ORM\Entity
 */
class Results
{
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
     * @var integer
     *
     * @ORM\Column(name="result_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $resultId;

    /**
     * @var \MissionControl\Bundle\ProjectBundle\Entity\Individualperformances
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\Individualperformances")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="individualperformance", referencedColumnName="individualperformance_id")
     * })
     */
    private $individualperformance;



    /**
     * Set globalperformance
     *
     * @param float $globalperformance
     * @return Results
     */
    public function setGlobalperformance($globalperformance)
    {
        $this->globalperformance = $globalperformance;

        return $this;
    }

    /**
     * Get globalperformance
     *
     * @return float 
     */
    public function getGlobalperformance()
    {
        return $this->globalperformance;
    }

    /**
     * Set reach
     *
     * @param float $reach
     * @return Results
     */
    public function setReach($reach)
    {
        $this->reach = $reach;

        return $this;
    }

    /**
     * Get reach
     *
     * @return float 
     */
    public function getReach()
    {
        return $this->reach;
    }

    /**
     * Get resultId
     *
     * @return integer 
     */
    public function getResultId()
    {
        return $this->resultId;
    }

    /**
     * Set individualperformance
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\Individualperformances $individualperformance
     * @return Results
     */
    public function setIndividualperformance(\MissionControl\Bundle\ProjectBundle\Entity\Individualperformances $individualperformance = null)
    {
        $this->individualperformance = $individualperformance;

        return $this;
    }

    /**
     * Get individualperformance
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\Individualperformances 
     */
    public function getIndividualperformance()
    {
        return $this->individualperformance;
    }
}
