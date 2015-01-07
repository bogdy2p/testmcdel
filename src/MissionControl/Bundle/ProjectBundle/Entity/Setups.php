<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Setups
 *
 * @ORM\Table(name="setups", uniqueConstraints={@ORM\UniqueConstraint(name="setup_id", columns={"setup_id"})}, indexes={@ORM\Index(name="fk_setups_surveys1_idx", columns={"survey"}), @ORM\Index(name="fk_setups_targets1_idx", columns={"target"}), @ORM\Index(name="fk_setups_clients1_idx", columns={"client"})})
 * @ORM\Entity
 */
class Setups
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="startdate", type="datetime", nullable=false)
     */
    private $startdate;

    /**
     * @var integer
     *
     * @ORM\Column(name="periodtype", type="integer", nullable=false)
     */
    private $periodtype;

    /**
     * @var integer
     *
     * @ORM\Column(name="nbperiods", type="integer", nullable=false)
     */
    private $nbperiods;

    /**
     * @var integer
     *
     * @ORM\Column(name="budget", type="integer", nullable=false)
     */
    private $budget;

    /**
     * @var string
     *
     * @ORM\Column(name="budgetcurrency", type="string", length=4, nullable=false)
     */
    private $budgetcurrency;

    /**
     * @var integer
     *
     * @ORM\Column(name="setup_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $setupId;

    /**
     * @var \MissionControl\Bundle\ProjectBundle\Entity\Clients
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\Clients", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="client", referencedColumnName="client_id")
     * })
     */
    private $client;

    /**
     * @var \MissionControl\Bundle\ProjectBundle\Entity\Targets
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\Targets", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="target", referencedColumnName="target_id")
     * })
     */
    private $target;

    /**
     * @var \MissionControl\Bundle\ProjectBundle\Entity\Surveys
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\Surveys", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="survey", referencedColumnName="survey_id")
     * })
     */
    private $survey;



    /**
     * Set startdate
     *
     * @param \DateTime $startdate
     * @return Setups
     */
    public function setStartdate($startdate)
    {
        $this->startdate = $startdate;

        return $this;
    }

    /**
     * Get startdate
     *
     * @return \DateTime 
     */
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * Set periodtype
     *
     * @param integer $periodtype
     * @return Setups
     */
    public function setPeriodtype($periodtype)
    {
        $this->periodtype = $periodtype;

        return $this;
    }

    /**
     * Get periodtype
     *
     * @return integer 
     */
    public function getPeriodtype()
    {
        return $this->periodtype;
    }

    /**
     * Set nbperiods
     *
     * @param integer $nbperiods
     * @return Setups
     */
    public function setNbperiods($nbperiods)
    {
        $this->nbperiods = $nbperiods;

        return $this;
    }

    /**
     * Get nbperiods
     *
     * @return integer 
     */
    public function getNbperiods()
    {
        return $this->nbperiods;
    }

    /**
     * Set budget
     *
     * @param integer $budget
     * @return Setups
     */
    public function setBudget($budget)
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * Get budget
     *
     * @return integer 
     */
    public function getBudget()
    {
        return $this->budget;
    }

    /**
     * Set budgetcurrency
     *
     * @param string $budgetcurrency
     * @return Setups
     */
    public function setBudgetcurrency($budgetcurrency)
    {
        $this->budgetcurrency = $budgetcurrency;

        return $this;
    }

    /**
     * Get budgetcurrency
     *
     * @return string 
     */
    public function getBudgetcurrency()
    {
        return $this->budgetcurrency;
    }

    /**
     * Get setupId
     *
     * @return integer 
     */
    public function getSetupId()
    {
        return $this->setupId;
    }

    /**
     * Set client
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\Clients $client
     * @return Setups
     */
    public function setClient(\MissionControl\Bundle\ProjectBundle\Entity\Clients $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\Clients 
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set target
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\Targets $target
     * @return Setups
     */
    public function setTarget(\MissionControl\Bundle\ProjectBundle\Entity\Targets $target = null)
    {
        $this->target = $target;

        return $this;
    }

    /**
     * Get target
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\Targets 
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set survey
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\Surveys $survey
     * @return Setups
     */
    public function setSurvey(\MissionControl\Bundle\ProjectBundle\Entity\Surveys $survey = null)
    {
        $this->survey = $survey;

        return $this;
    }

    /**
     * Get survey
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\Surveys 
     */
    public function getSurvey()
    {
        return $this->survey;
    }
}
