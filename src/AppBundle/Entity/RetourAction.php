<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RetourAction
 *
 * @ORM\Table(name="retour_action")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\RetourActionRepository")
 */
class RetourAction
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="retourAction", cascade="persist")
     *
     */
    private $user;
    
    /**
     * @var Avis
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Avis", inversedBy="retourAction", cascade="persist")
     *
     */
    private $avis;
    
    /**
     * @var Action
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Action", inversedBy="retourAction", cascade="persist")
     *
     */
    private $action;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return RetourAction
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set avis
     *
     * @param \AppBundle\Entity\Avis $avis
     *
     * @return RetourAction
     */
    public function setAvis(\AppBundle\Entity\Avis $avis = null)
    {
        $this->avis = $avis;

        return $this;
    }

    /**
     * Get avis
     *
     * @return \AppBundle\Entity\Avis
     */
    public function getAvis()
    {
        return $this->avis;
    }

    /**
     * Set action
     *
     * @param \AppBundle\Entity\Action $action
     *
     * @return RetourAction
     */
    public function setAction(\AppBundle\Entity\Action $action = null)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return \AppBundle\Entity\Action
     */
    public function getAction()
    {
        return $this->action;
    }
}
