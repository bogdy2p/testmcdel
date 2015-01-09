<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Cprattributes
 *
 * @ORM\Table(name="cprattributes")
 * @ORM\Entity
 */
class Cprattributes {

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=45, nullable=true)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=45, nullable=true)
     */
    private $description;

    /**
     * @var integer
     *
     * @ORM\Column(name="selected", type="integer", nullable=true)
     */
    private $selected;

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
     * @var integer
     *
     * @ORM\Column(name="cprattribute_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $cprattributeId;

    /**
     * Set name
     *
     * @param string $name
     * @return Cprattributes
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
     * Set description
     *
     * @param string $description
     * @return Cprattributes
     */
    public function setDescription($description) {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set selected
     *
     * @param integer $selected
     * @return Cprattributes
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
     * Get cprattributeId
     *
     * @return integer 
     */
    public function getCprattributeId() {
        return $this->cprattributeId;
    }

}
