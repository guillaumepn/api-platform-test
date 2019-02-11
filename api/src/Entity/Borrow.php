<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ApiResource()
 * @ORM\Entity(repositoryClass="App\Repository\BorrowRepository")
 */
class Borrow
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $borrowing_date;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $return_date;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $state;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Borrower", inversedBy="borrows")
     */
    private $borrower_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\CopyBook", inversedBy="borrows")
     */
    private $copybook_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBorrowingDate(): ?\DateTimeInterface
    {
        return $this->borrowing_date;
    }

    public function setBorrowingDate(?\DateTimeInterface $borrowing_date): self
    {
        $this->borrowing_date = $borrowing_date;

        return $this;
    }

    public function getReturnDate(): ?\DateTimeInterface
    {
        return $this->return_date;
    }

    public function setReturnDate(?\DateTimeInterface $return_date): self
    {
        $this->return_date = $return_date;

        return $this;
    }

    public function getState(): ?bool
    {
        return $this->state;
    }

    public function setState(?bool $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getBorrowerId(): ?Borrower
    {
        return $this->borrower_id;
    }

    public function setBorrowerId(?Borrower $borrower_id): self
    {
        $this->borrower_id = $borrower_id;

        return $this;
    }

    public function getCopybookId(): ?CopyBook
    {
        return $this->copybook_id;
    }

    public function setCopybookId(?CopyBook $copybook_id): self
    {
        $this->copybook_id = $copybook_id;

        return $this;
    }
}
