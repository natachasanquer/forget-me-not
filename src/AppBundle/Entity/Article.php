<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Article
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ArticleRepository")
 */
class Article
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
     * @var int
     *
     * @ORM\Column(name="caution", type="integer")
     */
    private $caution;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="description",type="string",length=2000)
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="titre",type="string",length=100)
     *
     */
    private $titre;
    
    /**
     * @var string
     *
     * @ORM\Column(name="marque",type="string",length=50)
     */
    private $marque;

    /**
     * @var boolean
     *
     * @ORM\Column(name="aVendre",type="boolean")
     */
    private $aVendre;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estArchive",type="boolean")
     */
    private $estArchive;

    /**
     * @var Taille
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Taille", inversedBy="articles")
     */
    private $taille;

    /**
     * @var Type
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Type", inversedBy="articles")
     *
     */
    private $type;

    /**
     * @var boolean
     *
     * @ORM\Column(name="estAccepte", type="boolean")
     *
     */
    private $estAccepte;

    /**
     * @var Action
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Action", mappedBy="article")
     */
    private $actions;

    /**
     * @var Image
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Image", mappedBy="article")
     */
    private $images;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string", length=255, unique=true)
     */
    private $slug;

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
     * Set type
     *
     * @param string $type
     *
     * @return Article
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set taille
     *
     * @param string $taille
     *
     * @return Article
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get taille
     *
     * @return string
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set caution
     *
     * @param integer $caution
     *
     * @return Article
     */
    public function setCaution($caution)
    {
        $this->caution = $caution;

        return $this;
    }

    /**
     * Get caution
     *
     * @return int
     */
    public function getCaution()
    {
        return $this->caution;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return Article
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Article
     */
    public function setUser(\AppBundle\Entity\User $user)
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
     * Set description
     *
     * @param string $description
     *
     * @return Article
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set marque
     *
     * @param string $marque
     *
     * @return Article
     */
    public function setMarque($marque)
    {
        $this->marque = $marque;

        return $this;
    }

    /**
     * Get marque
     *
     * @return string
     */
    public function getMarque()
    {
        return $this->marque;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Article
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set aVendre
     *
     * @param boolean $aVendre
     *
     * @return Article
     */
    public function setAVendre($aVendre)
    {
        $this->aVendre = $aVendre;

        return $this;
    }

    /**
     * Get aVendre
     *
     * @return boolean
     */
    public function getAVendre()
    {
        return $this->aVendre;
    }

    /**
     * Set estArchive
     *
     * @param boolean $estArchive
     *
     * @return Article
     */
    public function setEstArchive($estArchive)
    {
        $this->estArchive = $estArchive;

        return $this;
    }

    /**
     * Get estArchive
     *
     * @return boolean
     */
    public function getEstArchive()
    {
        return $this->estArchive;
    }

    /**
     * Set estAccepte
     *
     * @param boolean $estAccepte
     *
     * @return Article
     */
    public function setEstAccepte($estAccepte)
    {
        $this->estAccepte = $estAccepte;

        return $this;
    }

    /**
     * Get estAccepte
     *
     * @return boolean
     */
    public function getEstAccepte()
    {
        return $this->estAccepte;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->action = new Action();
    }

    /**
     * Add action
     *
     * @param \AppBundle\Entity\Action $action
     *
     * @return Article
     */
    public function addAction(\AppBundle\Entity\Action $actions)
    {
        $this->actions[] = $actions;

        return $this;
    }

    /**
     * Remove action
     *
     * @param \AppBundle\Entity\Action $action
     */
    public function removeAction(\AppBundle\Entity\Action $actions)
    {
        $this->actions->removeElement($actions);
    }

    /**
     * Get action
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAction()
    {
        return $this->actions;
    }

    /**
     * Get actions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Set slug
     *
     * @param string $slug
     *
     * @return Article
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
     * Add image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return Article
     */
    public function addImage(\AppBundle\Entity\Image $image)
    {
        $this->images[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Image $image
     */
    public function removeImage(\AppBundle\Entity\Image $image)
    {
        $this->images->removeElement($image);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImages()
    {
        return $this->images;
    }
}
