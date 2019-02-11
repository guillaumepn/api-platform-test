<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\CopyBookRepository")
 */
class CopyBook
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $copybook_number;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Book", inversedBy="copyBooks")
     */
    private $book_id;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Borrow", mappedBy="copybook_id")
     */
    private $borrows;

    public function __construct()
    {
        $this->borrows = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCopybookNumber(): ?int
    {
        return $this->copybook_number;
    }

    public function setCopybookNumber(?int $copybook_number): self
    {
        $this->copybook_number = $copybook_number;

        return $this;
    }

    public function getBookId(): ?Book
    {
        return $this->book_id;
    }

    public function setBookId(?Book $book_id): self
    {
        $this->book_id = $book_id;

        return $this;
    }

    /**
     * @return Collection|Borrow[]
     */
    public function getBorrows(): Collection
    {
        return $this->borrows;
    }

    public function addBorrow(Borrow $borrow): self
    {
        if (!$this->borrows->contains($borrow)) {
            $this->borrows[] = $borrow;
            $borrow->setCopybookId($this);
        }

        return $this;
    }

    public function removeBorrow(Borrow $borrow): self
    {
        if ($this->borrows->contains($borrow)) {
            $this->borrows->removeElement($borrow);
            // set the owning side to null (unless already changed)
            if ($borrow->getCopybookId() === $this) {
                $borrow->setCopybookId(null);
            }
        }

        return $this;
    }
}
