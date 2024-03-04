<?php

namespace App\Entity;

use App\Repository\CommentariesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommentariesRepository::class)]
class Commentaries
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'commentaries')]
    private ?User $Author = null;

    #[ORM\Column(length: 255)]
    private ?string $text = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\ManyToOne(inversedBy: 'commentaries')]
    #[ORM\JoinColumn(onDelete:"CASCADE")]
    private ?Characters $Build = null;

    #[ORM\Column(nullable: true)]
    private ?\DateTimeImmutable $modifiedAt = null;

    #[ORM\Column(options: ["default" => 0])]
    private ?bool $isFlaged = false;

    #[ORM\ManyToOne(targetEntity: self::class, inversedBy: 'IsResponseTo')]
    // #[ORM\JoinColumn(onDelete:"CASCADE")]
    private ?self $response = null;

    #[ORM\OneToMany(targetEntity: self::class, mappedBy: 'response', cascade: ['persist'])]
    private Collection $IsResponseTo;

    public function __construct()
    {
        $this->IsResponseTo = new ArrayCollection();
    }

 
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?User
    {
        return $this->Author;
    }

    public function setAuthor(?User $Author): static
    {
        $this->Author = $Author;

        return $this;
    }

    public function getText(): ?string
    {
        return $this->text;
    }

    public function setText(string $text): static
    {
        $this->text = $text;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getBuild(): ?Characters
    {
        return $this->Build;
    }

    public function setBuild(?Characters $Build): static
    {
        $this->Build = $Build;

        return $this;
    }

    public function getModifiedAt(): ?\DateTimeImmutable
    {
        return $this->modifiedAt;
    }

    public function setModifiedAt(?\DateTimeImmutable $modifiedAt): static
    {
        $this->modifiedAt = $modifiedAt;

        return $this;
    }

    public function isIsFlaged(): ?bool
    {
        return $this->isFlaged;
    }

    public function setIsFlaged(bool $isFlaged): static
    {
        $this->isFlaged = $isFlaged;

        return $this;
    }

    public function getResponse(): ?self
    {
        return $this->response;
    }

    public function setResponse(?self $response): static
    {
        $this->response = $response;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getIsResponseTo(): Collection
    {
        return $this->IsResponseTo;
    }

    public function addIsResponseTo(self $isResponseTo): static
    {
        if (!$this->IsResponseTo->contains($isResponseTo)) {
            $this->IsResponseTo->add($isResponseTo);
            $isResponseTo->setResponse($this);
        }

        return $this;
    }

    public function removeIsResponseTo(self $isResponseTo): static
    {
        if ($this->IsResponseTo->removeElement($isResponseTo)) {
            // set the owning side to null (unless already changed)
            if ($isResponseTo->getResponse() === $this) {
                $isResponseTo->setResponse(null);
            }
        }

        return $this;
    }

    public function isThisResponseTo(self $commentary): bool
    {
        return $this->response === $commentary;
    }


}
