<?php

namespace MissionControl\Bundle\ProjectBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Surveys
 *
 * @ORM\Table(name="surveys")
 * @ORM\Entity
 */
class Surveys
{
    /**
     * @var integer
     *
     * @ORM\Column(name="dbid", type="integer", nullable=true)
     */
    private $dbid;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=true)
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="survey_id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $surveyId;



    /**
     * Set dbid
     *
     * @param integer $dbid
     * @return Surveys
     */
    public function setDbid($dbid)
    {
        $this->dbid = $dbid;

        return $this;
    }

    /**
     * Get dbid
     *
     * @return integer 
     */
    public function getDbid()
    {
        return $this->dbid;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Surveys
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get surveyId
     *
     * @return integer 
     */
    public function getSurveyId()
    {
        return $this->surveyId;
    }
}
