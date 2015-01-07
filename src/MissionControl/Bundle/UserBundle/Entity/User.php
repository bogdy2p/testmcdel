<?php

namespace MissionControl\Bundle\UserBundle\Entity;

// For extending FOSUserBundle:
use FOS\UserBundle\Entity\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;

// For setting validation constraints:
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="control_user")
 */
class User extends BaseUser {

	public function __construct() {
        parent::__construct();
        
        $this->projects = new ArrayCollection();
        
    }

	/**
	 * @ORM\Id
	 * @ORM\Column(type="integer")
	 * @ORM\GeneratedValue(strategy="AUTO")
	 */
	protected $id;
    
	/**
     * @ORM\Column(type="string", name="api_key", nullable=true)
     */
    protected $apiKey;
    
    /**
     * @ORM\OneToMany(targetEntity="MissionControl\Bundle\ProjectBundle\Entity\Project", mappedBy="user")
     */
    protected $projects;

    /**
     * Set apiKey
     *
     * @param string $apiKey
     * @return Users
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Get apiKey
     *
     * @return string 
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * Confirm entered password.
     * @return boolean
     */
    public function getPasswordCheck($password, $confirm) 
    {
   		return $password == $confirm;
    }
    
    public function getProjects() {
        return $this->projects;
    }
    
}