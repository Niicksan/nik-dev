<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAdded;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $isFound;

    /**
     * @ORM\Column(type="string", length=128)
     */
    private $town;

    /**
     * @ORM\Column(type="string", length=32)
     */
    private $phone;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $summary;

    /**
     * @ORM\Column(name="authorId", type="integer")
     */
    private $authorId;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="articles")
     * @ORM\JoinColumn(name="authorId", referencedColumnName="id")
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $imageFilename;

    public function __construct()
    {
        $this->dateAdded = new \DateTime('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent($content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDateAdded(): ?\DateTime
    {
        return $this->dateAdded;
    }

    public function setDateAdded($dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }

    public function getIsFound(): ?string
    {
        return $this->isFound;
    }

    public function setIsFound($isFound): self
    {
        $this->isFound = $isFound;

        return $this;
    }

    public function getTown(): ?string
    {
        return $this->town;
    }

    public function setTown($town): self
    {
        $this->town = $town;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone($phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getSummary()
    {
        if ($this->summary === null)
        {
            $this->setSummary();
        }

        return $this->summary;
    }

    public function setSummary(): void
    {
//        if (strlen($this->getContent()) > 100)
//        {
//            $this->summary = substr($this->getContent(), 0,
//                    strlen($this->getContent()) / 2) . "...";
//        }
//        else
//        {
//            $this->summary = $this->getContent();
//        }
        $this->summary = $this->getContent();
    }

    public function getAuthorId()
    {
        return $this->authorId;
    }

    public function setAuthorId($authorId): self
    {
        $this->authorId = $authorId;

        return $this;
    }

    /**
     * Get Author
     *
     * @return \App\Entity\User
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?UserInterface $author)
    {
        $this->author = $author;
        return $this;
    }

    public function getImageFilename(): ?string
    {
        return $this->imageFilename;
    }

    public function setImageFilename($imageFilename): self
    {
        $this->imageFilename = $imageFilename;

        return $this;
    }
}