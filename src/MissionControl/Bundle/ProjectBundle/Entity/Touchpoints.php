<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * Touchpoints
 *
 * @ORM\Table(name="touchpoints")
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

}
