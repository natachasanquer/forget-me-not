<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EtatLieu
 *
 * @ORM\Table(name="etat_lieu")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EtatLieuRepository")
 */
class EtatLieu
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
     * @var string
     *
     * @ORM\Column(name="commentaires", type="string", length=255)
     */
    private $commentaires;

    /**
     * @var Action
     *
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Action", mappedBy="etatLieu")
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
     * Set commentaires
     *
     * @param string $commentaires
     *
     * @return EtatLieu
     */
    public function setCommentaires($commentaires)
    {
        $this->commentaires = $commentaires;

        return $this;
    }

    /**
     * Get commentaires
     *
     * @return string
     */
    public function getCommentaires()
    {
        return $this->commentaires;
    }

    /**
     * Set action
     *
     * @param \AppBundle\Entity\Action $action
     *
     * @return EtatLieu
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
