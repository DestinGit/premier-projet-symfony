<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Book
 *
 * @ORM\Table(name="books")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BookRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Book
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
     * @Assert\NotBlank(message="le titre ne peut être vide")
     * @Assert\Length(min="3", max="80",
     *     minMessage="Le titre doit comporter plus de {{limit}} caractères",
     *     maxMessage="Le titre doit comporter moins de {{limit}} caractères"
     *      )
     * @ORM\Column(name="title", type="string", length=80)
     */
    private $title;

    /**
     * @var ArrayCollection
     * @Assert\Count(min="1", max="4",
     *     minMessage="Un livre doit avoir au moins {{limit}} auteur(s)",
     *     maxMessage="Un livre doit avoir au plus {{limit}} auteur(s)")
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Author", inversedBy="books", cascade={"persist"})
     */
    private $authors;

    /**
     * @var string
     * @Assert\Range(min="2", max="80", invalidMessage="Le pix doit être compris entre 2 et 80")
     * @ORM\Column(name="price", type="decimal", precision=4, scale=2)
     */
    private $price;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="publishedAt", type="date")
     */
    private $publishedAt;

    /**
     * @var Publisher
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Publisher", inversedBy="books", cascade={"persist"})
     * @ORM\JoinColumn(nullable=false)
     */
    private $publisher;

    /**
     * @var \DateTime
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     * @ORM\Column(name="updated_at", type="datetime")
     */
    private $updatedAt;

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
     * Set title
     *
     * @param string $title
     *
     * @return Book
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Book
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set publishedAt
     *
     * @param \DateTime $publishedAt
     *
     * @return Book
     */
    public function setPublishedAt($publishedAt)
    {
        $this->publishedAt = $publishedAt;

        return $this;
    }

    /**
     * Get publishedAt
     *
     * @return \DateTime
     */
    public function getPublishedAt()
    {
        return $this->publishedAt;
    }

    /**
     * Set publisher
     *
     * @param \AppBundle\Entity\Publisher $publisher
     *
     * @return Book
     */
    public function setPublisher(\AppBundle\Entity\Publisher $publisher)
    {
        $this->publisher = $publisher;

        return $this;
    }

    /**
     * Get publisher
     *
     * @return \AppBundle\Entity\Publisher
     */
    public function getPublisher()
    {
        return $this->publisher;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->authors = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add author
     *
     * @param \AppBundle\Entity\Author $author
     *
     * @return Book
     */
    public function addAuthor(\AppBundle\Entity\Author $author)
    {
        $this->authors[] = $author;

        return $this;
    }

    /**
     * Remove author
     *
     * @param \AppBundle\Entity\Author $author
     */
    public function removeAuthor(\AppBundle\Entity\Author $author)
    {
        $this->authors->removeElement($author);
    }

    /**
     * Get authors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthors()
    {
        return $this->authors;
    }

    /**
     * @ORM\PrePersist()
     */
    public function prePersistEvent() {
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
}
