<?php

namespace AppBundle\Entity;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * User
 *
 * @UniqueEntity("username", message="Ce pseudo n'est pas dispo !")
 * @UniqueEntity("mail", message="Cet email est deja inscrit ici !")
 * @ORM\Table(name="app_user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface
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
     * @ORM\Column(name="username", type="string", length=100, unique=true)
     */
    private $username;
    
    /**
     * @var string
     *
     * @ORM\Column(name="phoneNumber", type="string", length=10, unique=true)
     */
    private $phoneNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=100, unique=true)
     */
    private $mail;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="datetime")
     */
    private $dateCreation;

    /**
     * @var string
     *
     * @ORM\Column(name="localite", type="string", length=255)
     */
    private $localite;

    /**
     * @var int
     *
     * @ORM\Column(name="points", type="integer")
     */
    private $points;

    /**
     * @var float
     *
     * @ORM\Column(name="porte_feuille", type="float")
     */
    private $porteFeuille;

    /**
     * @var string
     *
     * @ORM\Column(name="roles", type="string", length=30)
     */
    private $roles;

    /**
     * @var Article
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Article", mappedBy="user")
     */
    private $articles;
    
    /**
     * @var Conversation
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Conversation", mappedBy="user")
     */
    private $conversations;

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
     * @Orm\OneToMany(targetEntity="AppBundle\Entity\Action", mappedBy="user")
     *
     */
    private $actions;

    /**
     * @var Image
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Image", mappedBy="user")
     *
     */
    private $image;
    
    /**
     * @var RetourAction
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RetourAction", mappedBy="user")
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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return User
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     *
     * @return User
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
     * Set localite
     *
     * @param string $localite
     *
     * @return User
     */
    public function setLocalite($localite)
    {
        $this->localite = $localite;

        return $this;
    }

    /**
     * Get localite
     *
     * @return string
     */
    public function getLocalite()
    {
        return $this->localite;
    }

    /**
     * Set points
     *
     * @param integer $points
     *
     * @return User
     */
    public function setPoints($points)
    {
        $this->points = $points;

        return $this;
    }

    /**
     * Get points
     *
     * @return int
     */
    public function getPoints()
    {
        return $this->points;
    }

    public function incrementPoint(){
        $this->points++;
    }

    /**
     * Set porteFeuille
     *
     * @param float $porteFeuille
     *
     * @return User
     */
    public function setPorteFeuille($porteFeuille)
    {
        $this->porteFeuille = $porteFeuille;

        return $this;
    }

    /**
     * Get porteFeuille
     *
     * @return float
     */
    public function getPorteFeuille()
    {
        return $this->porteFeuille;
    }


    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
    }

    /**
     * Returns the roles granted to the user.
     *
     * <code>
     * public function getRoles()
     * {
     *     return array('ROLE_USER');
     * }
     * </code>
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return (Role|string)[] The user roles
     */
    public function getRoles()
    {
        return [$this->roles];
    }

    /**
     * Returns the password used to authenticate the user.
     *
     * This should be the encoded password. On authentication, a plain-text
     * password will be salted, encoded, and then compared to this value.
     *
     * @return string The password
     */
    public function getPassword()
    {
        return $this->password;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->articles = new Article();
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Set roles
     *
     * @param string $roles
     *
     * @return User
     */
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * Add article
     *
     * @param \AppBundle\Entity\Article $article
     *
     * @return User
     */
    public function addArticle(\AppBundle\Entity\Article $article)
    {
        $this->articles[] = $article;

        return $this;
    }

    /**
     * Remove article
     *
     * @param \AppBundle\Entity\Article $article
     */
    public function removeArticle(\AppBundle\Entity\Article $article)
    {
        $this->articles->removeElement($article);
    }

    /**
     * Get articles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getArticles()
    {
        return $this->articles;
    }

    /**
     * Set estAccepte
     *
     * @param boolean $estAccepte
     *
     * @return User
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
     * Add action
     *
     * @param \appBundle\Entity\Action $action
     *
     * @return User
     */
    public function addAction(\appBundle\Entity\Action $action)
    {
        $this->actions[] = $action;

        return $this;
    }

    /**
     * Remove action
     *
     * @param \appBundle\Entity\Action $action
     */
    public function removeAction(\appBundle\Entity\Action $action)
    {
        $this->actions->removeElement($action);
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
     * Set image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return User
     */
    public function setImage(\AppBundle\Entity\Image $image = null)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return \AppBundle\Entity\Image
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set phoneNumber
     *
     * @param string $phoneNumber
     *
     * @return User
     */
    public function setPhoneNumber($phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;

        return $this;
    }

    /**
     * Get phoneNumber
     *
     * @return string
     */
    public function getPhoneNumber()
    {
        return $this->phoneNumber;
    }

    /**
     * Add image
     *
     * @param \AppBundle\Entity\Image $image
     *
     * @return User
     */
    public function addImage(\AppBundle\Entity\Image $image)
    {
        $this->image[] = $image;

        return $this;
    }

    /**
     * Remove image
     *
     * @param \AppBundle\Entity\Image $image
     */
    public function removeImage(\AppBundle\Entity\Image $image)
    {
        $this->image->removeElement($image);
    }
    
    /**
     * Add points
     * 
     * @param nbPoints
     */
    public function addPoints(int $nbPoints){
        $this->points = $this->points + $nbPoints;
    }

    /**
     * Add conversation
     *
     * @param \AppBundle\Entity\Conversation $conversation
     *
     * @return User
     */
    public function addConversation(\AppBundle\Entity\Conversation $conversation)
    {
        $this->conversations[] = $conversation;

        return $this;
    }

    /**
     * Remove conversation
     *
     * @param \AppBundle\Entity\Conversation $conversation
     */
    public function removeConversation(\AppBundle\Entity\Conversation $conversation)
    {
        $this->conversations->removeElement($conversation);
    }

    /**
     * Get conversations
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getConversations()
    {
        return $this->conversations;
    }

    /**
     * Add retourAction
     *
     * @param \AppBundle\Entity\RetourAction $retourAction
     *
     * @return User
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
