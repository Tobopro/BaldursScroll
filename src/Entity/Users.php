<?php

namespace App\Entity;

use App\Repository\UsersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UsersRepository::class)]
class Users
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $username = null;

    #[ORM\Column(length: 100)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $signInDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profilePicture = null;

    #[ORM\Column]
    private ?bool $isBanned = null;

    #[ORM\Column]
    private ?bool $isAdmin = null;

    #[ORM\OneToMany(targetEntity: Characteres::class, mappedBy: 'idUsers')]
    private Collection $characteres;

    public function __construct()
    {
        $this->characteres = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): static
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getSignInDate(): ?\DateTimeInterface
    {
        return $this->signInDate;
    }

    public function setSignInDate(\DateTimeInterface $signInDate): static
    {
        $this->signInDate = $signInDate;

        return $this;
    }

    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePicture): static
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    public function isIsBanned(): ?bool
    {
        return $this->isBanned;
    }

    public function setIsBanned(bool $isBanned): static
    {
        $this->isBanned = $isBanned;

        return $this;
    }

    public function isIsAdmin(): ?bool
    {
        return $this->isAdmin;
    }

    public function setIsAdmin(bool $isAdmin): static
    {
        $this->isAdmin = $isAdmin;

        return $this;
    }

    /**
     * @return Collection<int, Characteres>
     */
    public function getCharacteres(): Collection
    {
        return $this->characteres;
    }

    public function addCharactere(Characteres $charactere): static
    {
        if (!$this->characteres->contains($charactere)) {
            $this->characteres->add($charactere);
            $charactere->setIdUsers($this);
        }

        return $this;
    }

    public function removeCharactere(Characteres $charactere): static
    {
        if ($this->characteres->removeElement($charactere)) {
            // set the owning side to null (unless already changed)
            if ($charactere->getIdUsers() === $this) {
                $charactere->setIdUsers(null);
            }
        }

        return $this;
    }
}
