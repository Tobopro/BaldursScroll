<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]  // manually added

class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?array $roles = null;

    #[ORM\Column(length: 50)]
    private ?string $username = null;

    #[ORM\Column(length: 100, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    private ?string $password = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, options: ["default" => "NOW()"])]
    private ?\DateTimeInterface $signInDate = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $profilePicture = null;

    #[ORM\OneToMany(targetEntity: ResetPasswordRequest::class, mappedBy: 'user')]
    private ?Collection $resetPasswordRequests = null;

    #[ORM\OneToMany(targetEntity: Characters::class, mappedBy: 'idUsers')]
    private Collection $characters;

    #[ORM\OneToMany(targetEntity: Commentaries::class, mappedBy: 'Author')]
    private Collection $commentaries;

    #[ORM\Column(options: ["default" => 0])]
    private ?bool $IsBanned = false;

    #[ORM\ManyToMany(targetEntity: characters::class, inversedBy: 'liked')]
    private Collection $liked;

    #[ORM\Column(options: ["default" => 0])]
    private ?bool $isFlaged = false;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
        $this->commentaries = new ArrayCollection();
        $this->resetPasswordRequests = new ArrayCollection();
        $this->liked = new ArrayCollection();
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

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        // Vérifiez que $roles n'est pas null avant l'assignation
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @return Collection<int, characters>
     */
    public function getcharacters(): Collection
    {
        return $this->characters;
    }

    public function addcharacter(characters $character): static
    {
        if (!$this->characters->contains($character)) {
            $this->characters->add($character);
            $character->setIdUsers($this);
        }

        return $this;
    }

    public function removecharacter(characters $character): static
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getIdUsers() === $this) {
                $character->setIdUsers(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Commentaries>
     */
    public function getCommentaries(): Collection
    {
        return $this->commentaries;
    }

    public function addCommentary(Commentaries $commentary): static
    {
        if (!$this->commentaries->contains($commentary)) {
            $this->commentaries->add($commentary);
            $commentary->setAuthor($this);
        }

        return $this;
    }

    public function removeCommentary(Commentaries $commentary): static
    {
        if ($this->commentaries->removeElement($commentary)) {
            // set the owning side to null (unless already changed)
            if ($commentary->getAuthor() === $this) {
                $commentary->setAuthor(null);
            }
        }

        return $this;
    }

    public function isIsBanned(): ?bool
    {
        return $this->IsBanned;
    }

    public function setIsBanned(bool $IsBanned): static
    {
        $this->IsBanned = $IsBanned;

        return $this;
    }
    /**
     * @return Collection<int, ResetPasswordRequest>
     */
    public function getResetPasswordRequests(): Collection
    {
        return $this->resetPasswordRequests;
    }

    public function addResetPasswordRequest(ResetPasswordRequest $resetPasswordRequest): static
    {
        if (!$this->resetPasswordRequests->contains($resetPasswordRequest)) {
            $this->resetPasswordRequests->add($resetPasswordRequest);
            $resetPasswordRequest->setUser($this);
        }

        return $this;
    }
    public function removeResetPasswordRequest(ResetPasswordRequest $resetPasswordRequest): static
    {
        if ($this->resetPasswordRequests->removeElement($resetPasswordRequest)) {

            if ($resetPasswordRequest->getUser() === $this) {
                $resetPasswordRequest->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, characters>
     */
    public function getLiked(): Collection
    {
        return $this->liked;
    }

    public function doesLikes(Characters $character): bool
    {
        return $this->liked->contains($character);
    }

    public function addLiked(characters $liked): static
    {
        if (!$this->liked->contains($liked)) {
            $this->liked->add($liked);
        }

        return $this;
    }

    public function removeLiked(characters $liked): static
    {
        $this->liked->removeElement($liked);

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
}
