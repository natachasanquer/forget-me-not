<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Action
 *
 * @ORM\Table(name="action")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ActionRepository")
 */
class Action
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
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="datetime")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateFin", type="datetime", nullable=true)
     */
    private $dateFin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDemande", type="datetime", nullable=false)
     */
    private $dateDemande;

    /**
     * @var TypeAction
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\TypeAction", inversedBy="actions")
     */
    private $type;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="actions")
     */
    private $user;

    /**
     * @var Article
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Article", inversedBy="actions")
     */
    private $article;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estValide", type="boolean")
     */
    private $estValide;
    /**
     * @var boolean
     *
     * @ORM\Column(name="estRefuse", type="boolean")
     */
    private $estRefuse;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string")
     */
    private $etat;
    
    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

    /**
     * @var String
     *
     * @ORM\Column(name="commentaire", type="string")
     *
     */
    private $commentaire;
    
    
    /**
     * @var RetourAction
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RetourAction",mappedBy="action")
     */
    private $retourAction;
    
    
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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return Action
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set dateFin
     *
     * @param \DateTime $dateFin
     *
     * @return Action
     */
    public function setDateFin($dateFin)
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    /**
     * Get dateFin
     *
     * @return \DateTime
     */
    public function getDateFin()
    {
        return $this->dateFin;
    }

    /**
     * Set type
     *
     * @param \AppBundle\Entity\TypeAction $type
     *
     * @return Action
     */
    public function setType(\AppBundle\Entity\TypeAction $type = null)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return \AppBundle\Entity\TypeAction
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Action
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
     * Set article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return Action
     */
    public function setArticle(\AppBundle\Entity\Article $article = null)
    {
        $this->article = $article;

        return $this;
    }

    /**
     * Set estValide
     *
     * @param boolean $estValide
     *
     * @return Action
     */
    public function setEstValide($estValide)
    {
        $this->estValide = $estValide;

        return $this;
    }

    /**
     * Get estValide
     *
     * @return boolean
     */
    public function getEstValide()
    {
        return $this->estValide;
    }
    /**
     * Set estValide
     *
     * @param boolean $estValide
     *
     * @return Action
     */
    public function setEstRefuse($estRefuse)
    {
        $this->estRefuse = $estRefuse;

        return $this;
    }

    /**
     * Get estRefuse
     *
     * @return boolean
     */
    public function getEstRefuse()
    {
        return $this->estRefuse;
    }
    /**
     * Get article
     *
     * @return \AppBundle\Entity\Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    /**
     * Set dateDemande
     *
     * @param \DateTime $dateDemande
     *
     * @return Action
     */
    public function setDateDemande($dateDemande)
    {
        $this->dateDemande = $dateDemande;

        return $this;
    }

    /**
     * Get dateDemande
     *
     * @return \DateTime
     */
    public function getDateDemande()
    {
        return $this->dateDemande;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Action
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * Get slug
     *
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * Set etat
     *
     * @param string $etat
     *
     * @return Action
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Action
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->avis = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add avi
     *
     * @param \AppBundle\Entity\Avis $avi
     *
     * @return Action
     */
    public function addAvi(\AppBundle\Entity\Avis $avi)
    {
        $this->avis[] = $avi;

        return $this;
    }

    /**
     * Remove avi
     *
     * @param \AppBundle\Entity\Avis $avi
     */
    public function removeAvi(\AppBundle\Entity\Avis $avi)
    {
        $this->avis->removeElement($avi);
    }

    /**
     * Get avis
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAvis()
    {
        return $this->avis;
    }

    /**
     * Add retourAction
     *
     * @param \AppBundle\Entity\RetourAction $retourAction
     *
     * @return Action
     */
    public function addRetourAction(\AppBundle\Entity\RetourAction $retourAction)
    {
        $this->retourAction[] = $retourAction;

        return $this;
    }

    /**
     * Remove retourAction
     *
     * @param \AppBundle\Entity\RetourAction $retourAction
     */
    public function removeRetourAction(\AppBundle\Entity\RetourAction $retourAction)
    {
        $this->retourAction->removeElement($retourAction);
    }

    /**
     * Get retourAction
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRetourAction()
    {
        return $this->retourAction;
    }
}
