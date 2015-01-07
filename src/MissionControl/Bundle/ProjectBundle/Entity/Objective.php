<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Objectives
 *
 * @ORM\Table(name="objective")
 * @ORM\Entity
 */
class Objective {

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="htmlcolor", type="string", length=7, nullable=false)
     */
    private $htmlcolor;

    /**
     * @var boolean
     *
     * @ORM\Column(name="selected", type="boolean", nullable=false)
     */
    private $selected;

    /**
     * @var integer
     *
     * @ORM\Column(name="score", type="integer", nullable=false)
     */
    private $score;

    /**
     * @var integer
     *
     * @ORM\Column(name="objective_group", type="integer", nullable=false)
     */
    private $objectiveGroup;

    /**
     * @var integer
     *
     * @ORM\Column(name="objective_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $objectiveId;

    /**
     * Set Objective Group
     *
     * @param string $objectiveGroup
     * @return Objectives
     */
    public function setObjectiveGroup($objectiveGroup) {
        $this->objectiveGroup = $objectiveGroup;

        return $this;
    }

    /**
     * Get Objective Group
     *
     * @return string 
     */
    public function getObjectiveGroup() {
        return $this->objectiveGroup;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Objectives
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
     * Set htmlcolor
     *
     * @param string $htmlcolor
     * @return Objectives
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
     * @param boolean $selected
     * @return Objectives
     */
    public function setSelected($selected) {
        $this->selected = $selected;

        return $this;
    }

    /**
     * Get selected
     *
     * @return boolean 
     */
    public function getSelected() {
        return $this->selected;
    }

    /**
     * Set score
     *
     * @param integer $score
     * @return Objectives
     */
    public function setScore($score) {
        $this->score = $score;

        return $this;
    }

    /**
     * Get score
     *
     * @return integer 
     */
    public function getScore() {
        return $this->score;
    }

    /**
     * Get objectiveId
     *
     * @return integer 
     */
    public function getObjectiveId() {
        return $this->objectiveId;
    }

}
