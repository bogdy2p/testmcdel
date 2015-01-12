<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Lightxmlprojects
 *
 * @ORM\Table(name="lightxmlprojects", uniqueConstraints={@ORM\UniqueConstraint(name="project_id", columns={"project_id"})}, indexes={@ORM\Index(name="fk_projects_setups_idx", columns={"setup"}), @ORM\Index(name="fk_projects_objectives1_idx", columns={"objectives"}),})
 * @ORM\Entity
 */
class Lightxmlprojects {

    public function __construct() {
          //$this->setup = new ArrayCollection();
          //$this->objectives = new ArrayCollection();
    }

    /**
     * @var integer
     *
     * @ORM\Column(name="project_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $projectId;

    /**
     * @var string
     *
     * @ORM\Column(name="project_uid", type="string", length=36, nullable=false)
     */
    private $projectUniqueId;


//    /**
//     * @var \MissionControl\Bundle\ProjectBundle\Entity\Touchpoints
//     *
//     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\Touchpoints", cascade={"persist"})
//     * @ORM\JoinColumns({
//     *   @ORM\JoinColumn(name="touchpoints", referencedColumnName="touchpoint_id")
//     * })
//     */
//    private $touchpoints;
//
    /**
     * @var \MissionControl\Bundle\ProjectBundle\Entity\Setups
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\Setups", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="setup", referencedColumnName="setup_id")
     * })
     */
    private $setup;

    /**
     * @var \MissionControl\Bundle\ProjectBundle\Entity\Objectives
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\Objectives", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="objectives", referencedColumnName="objective_id")
     * })
     */
    private $objectives;

    /**
     * @var \MissionControl\Bundle\ProjectBundle\Entity\Cprattributes
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\Cprattributes", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="cprattributes", referencedColumnName="cprattribute_id")
     * })
     */
    private $cprattributes;

    /**
     * Get projectId
     *
     * @return integer 
     */
    public function getProjectId() {
        return $this->projectId;
    }

    /**
     * Get projectUniqueId
     *
     * @return string 
     */
    public function getProjectUniqueId() {
        return $this->projectUniqueId;
    }


    /**
     * Set projectUniqueId
     *
     * @return Lightxmlprojects
     */
    public function setProjectUniqueId($projectUniqueId) {
        $this->projectUniqueId = $projectUniqueId;
        return $this;
    }

//    /**
//     * Set touchpoints
//     *
//     * @param \MissionControl\Bundle\ProjectBundle\Entity\Touchpoints $touchpoints
//     * @return Lightxmlprojects
//     */
//    public function setTouchpoints(\MissionControl\Bundle\ProjectBundle\Entity\Touchpoints $touchpoints = null) {
//        $this->touchpoints = $touchpoints;
//
//        return $this;
//    }
//
//    /**
//     * Get touchpoints
//     *
//     * @return \MissionControl\Bundle\ProjectBundle\Entity\Touchpoints 
//     */
//    public function getTouchpoints() {
//        return $this->touchpoints;
//    }

    /**
     * Set setup
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\Setups $setup
     * @return Lightxmlprojects
     */
    public function setSetup(\MissionControl\Bundle\ProjectBundle\Entity\Setups $setup = null) {
        $this->setup = $setup;

        return $this;
    }

    /**
     * Get setup
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\Setups 
     */
    public function getSetup() {
        return $this->setup;
    }

    /**
     * Set objectives
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\Objectives $objectives
     * @return Lightxmlprojects
     */
    public function setObjectives(\MissionControl\Bundle\ProjectBundle\Entity\Objectives $objectives = null) {
        $this->objectives = $objectives;

        return $this;
    }

    /**
     * Get objectives
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\Objectives 
     */
    public function getObjectives() {
        return $this->objectives;
    }

    /**
     * Set cprattributes
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\Cprattributes $cprattributes
     * @return Lightxmlprojects
     */
    public function setCprattributes(\MissionControl\Bundle\ProjectBundle\Entity\Cprattributes $cprattributes = null) {
        $this->cprattributes = $cprattributes;

        return $this;
    }

    /**
     * Get cprattributes
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\Cprattributes 
     */
    public function getCprattributes() {
        return $this->cprattributes;
    }

}
