<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Touchpoints
 *
 * @ORM\Table(name="touchpoints", indexes={@ORM\Index(name="fk_touchpoints_objectivescores1_idx", columns={"objectivescores"}), @ORM\Index(name="fk_touchpoints_attributescores1_idx", columns={"attributescores"})})
 * @ORM\Entity
 */
class Touchpoints {

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="localname", type="string", length=45, nullable=false)
     */
    private $localname;

    /**
     * @var string
     *
     * @ORM\Column(name="htmlcolor", type="string", length=7, nullable=false)
     */
    private $htmlcolor;

    /**
     * @var integer
     *
     * @ORM\Column(name="selected", type="integer", nullable=false)
     */
    private $selected;

    /**
     * @var integer
     *
     * @ORM\Column(name="touchpoint_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $touchpointId;

    /**
     * @var \MissionControl\Bundle\ProjectBundle\Entity\Attributescores
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\Attributescores", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="attributescores", referencedColumnName="attributescore_id")
     * })
     */
    private $attributescores;

    /**
     * @var \MissionControl\Bundle\ProjectBundle\Entity\Objectivescores
     *
     * @ORM\ManyToOne(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\Objectivescores", cascade={"persist"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="objectivescores", referencedColumnName="objectivescore_id")
     * })
     */
    private $objectivescores;

    /**
     * @var integer
     *
     * @ORM\Column(name="project_id", type="string", nullable=false)
     */
    private $projectId;

    /**
     * Set ProjectId
     *
     * @param string $projectId
     * @return Objectives
     */
    public function setProjectId($projectId) {
        $this->projectId = $projectId;

        return $this;
    }

    /**
     * Get ProjectId
     *
     * @return string 
     */
    public function getProjectId() {
        return $this->projectId;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Touchpoints
     */
    public function setName($name) {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set localname
     *
     * @param string $localname
     * @return Touchpoints
     */
    public function setLocalname($localname) {
        $this->localname = $localname;

        return $this;
    }

    /**
     * Get localname
     *
     * @return string 
     */
    public function getLocalname() {
        return $this->localname;
    }

    /**
     * Set htmlcolor
     *
     * @param string $htmlcolor
     * @return Touchpoints
     */
    public function setHtmlcolor($htmlcolor) {
        $this->htmlcolor = $htmlcolor;

        return $this;
    }

    /**
     * Get htmlcolor
     *
     * @return string 
     */
    public function getHtmlcolor() {
        return $this->htmlcolor;
    }

    /**
     * Set selected
     *
     * @param integer $selected
     * @return Touchpoints
     */
    public function setSelected($selected) {
        $this->selected = $selected;

        return $this;
    }

    /**
     * Get selected
     *
     * @return integer 
     */
    public function getSelected() {
        return $this->selected;
    }

    /**
     * Get touchpointId
     *
     * @return integer 
     */
    public function getTouchpointId() {
        return $this->touchpointId;
    }

    /**
     * Set attributescores
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\Attributescores $attributescores
     * @return Touchpoints
     */
    public function setAttributescores(\MissionControl\Bundle\ProjectBundle\Entity\Attributescores $attributescores = null) {
        $this->attributescores = $attributescores;

        return $this;
    }

    /**
     * Get attributescores
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\Attributescores 
     */
    public function getAttributescores() {
        return $this->attributescores;
    }

    /**
     * Set objectivescores
     *
     * @param \MissionControl\Bundle\ProjectBundle\Entity\Objectivescores $objectivescores
     * @return Touchpoints
     */
    public function setObjectivescores(\MissionControl\Bundle\ProjectBundle\Entity\Objectivescores $objectivescores = null) {
        $this->objectivescores = $objectivescores;

        return $this;
    }

    /**
     * Get objectivescores
     *
     * @return \MissionControl\Bundle\ProjectBundle\Entity\Objectivescores 
     */
    public function getObjectivescores() {
        return $this->objectivescores;
    }

}
