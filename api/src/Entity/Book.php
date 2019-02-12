<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints\TestConstraint;

/**
 * @ApiResource(
 *     collectionOperations={
 *          "get",
 *          "post"={"validation_groups"={"Default", "postValidation"}}
 *     },
 *     itemOperations={
 *          "delete",
 *          "get",
 *          "put"={"validation_groups"={"Default", "putValidation"}}
 *     }
 * )
 * @ORM\Entity(repositoryClass="App\Repository\BookRepository")
 */
class Book
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $reference;

    /**
     * @var string Name of book
     * @Assert\NotBlank(groups={"postValidation"})
     * @TestConstraint
     *
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $publicationDate;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Author", inversedBy="books")
     */
    private $author_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\CopyBook", mappedBy="book_id")
     */
    private $copyBooks;


    public function __construct()
    {
        $this->copyBooks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): self
    {
        $this->reference = $reference;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): self
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }

    public function getAuthorId(): ?Author
    {
        return $this->author_id;
    }

    public function setAuthorId(?Author $author_id): self
    {
        $this->author_id = $author_id;

        return $this;
    }

    /**
     * @return Collection|CopyBook[]
     */
    public function getCopyBooks(): Collection
    {
        return $this->copyBooks;
    }

    public function addCopyBook(CopyBook $copyBook): self
    {
        if (!$this->copyBooks->contains($copyBook)) {
            $this->copyBooks[] = $copyBook;
            $copyBook->setBookId($this);
        }

        return $this;
    }

    public function removeCopyBook(CopyBook $copyBook): self
    {
        if ($this->copyBooks->contains($copyBook)) {
            $this->copyBooks->removeElement($copyBook);
            // set the owning side to null (unless already changed)
            if ($copyBook->getBookId() === $this) {
                $copyBook->setBookId(null);
            }
        }

        return $this;
    }
}
