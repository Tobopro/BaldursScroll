<?php

namespace App\Entity;

use App\Repository\CharactersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CharactersRepository::class)]
class Characters
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $strength = null;

    #[ORM\Column]
    private ?int $dexterity = null;

    #[ORM\Column]
    private ?int $constitution = null;

    #[ORM\Column]
    private ?int $intelligence = null;

    #[ORM\Column]
    private ?int $wisdom = null;

    #[ORM\Column]
    private ?int $charisma = null;

    #[ORM\Column(length: 20)]
    private ?string $abilityScoreBonus1 = "STR";

    #[ORM\Column(length: 20)]
    private ?string $abilityScoreBonus2 = "DEX";

    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: true)]
    private ?SubRaces $idSubRace = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: true)]
    private ?SubClasses $idSubClasses = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $idUsers = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    private ?Levels $idLevel = null;

    #[ORM\OneToMany(targetEntity: Commentaries::class, mappedBy: 'Build')]
    private Collection $commentaries;

    public function __construct()
    {
        $this->strength = 8;
        $this->dexterity = 8;
        $this->constitution = 8;
        $this->intelligence = 8;
        $this->wisdom = 8;
        $this->charisma = 8;
        $this->commentaries = new ArrayCollection();
    }





    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getStrength(): ?int
    {
        return $this->strength;
    }

    public function setStrength(int $strength): static
    {
        $this->strength = $strength;

        return $this;
    }

    public function getDexterity(): ?int
    {
        return $this->dexterity;
    }

    public function setDexterity(int $dexterity): static
    {
        $this->dexterity = $dexterity;

        return $this;
    }

    public function getConstitution(): ?int
    {
        return $this->constitution;
    }

    public function setConstitution(int $constitution): static
    {
        $this->constitution = $constitution;

        return $this;
    }

    public function getIntelligence(): ?int
    {
        return $this->intelligence;
    }

    public function setIntelligence(int $intelligence): static
    {
        $this->intelligence = $intelligence;

        return $this;
    }

    public function getWisdom(): ?int
    {
        return $this->wisdom;
    }

    public function setWisdom(int $wisdom): static
    {
        $this->wisdom = $wisdom;

        return $this;
    }

    public function getCharisma(): ?int
    {
        return $this->charisma;
    }

    public function setCharisma(int $charisma): static
    {
        $this->charisma = $charisma;

        return $this;
    }

    public function getAbilityScoreBonus1(): ?string
    {
        return $this->abilityScoreBonus1;
    }

    public function setAbilityScoreBonus1(string $abilityScoreBonus1): static
    {
        $this->abilityScoreBonus1 = $abilityScoreBonus1;

        return $this;
    }

    public function getAbilityScoreBonus2(): ?string
    {
        return $this->abilityScoreBonus2;
    }

    public function setAbilityScoreBonus2(string $abilityScoreBonus2): static
    {
        $this->abilityScoreBonus2 = $abilityScoreBonus2;

        return $this;
    }

    public function getIdSubRace(): ?SubRaces
    {
        return $this->idSubRace;
    }

    public function setIdSubRace(?SubRaces $idSubRace): static
    {
        $this->idSubRace = $idSubRace;

        return $this;
    }

    public function getIdSubClasses(): ?SubClasses
    {
        return $this->idSubClasses;
    }

    public function setIdSubClasses(?SubClasses $idSubClasses): static
    {
        $this->idSubClasses = $idSubClasses;

        return $this;
    }

    public function getIdUsers(): ?User
    {
        return $this->idUsers;
    }

    public function setIdUsers(?User $idUsers): static
    {
        $this->idUsers = $idUsers;

        return $this;
    }

    public function getIdLevel(): ?Levels
    {
        return $this->idLevel;
    }

    public function setIdLevel(?Levels $idLevel): static
    {
        $this->idLevel = $idLevel;

        return $this;
    }

    public function getClassName(): ?string
    {
        if ($this->idSubClasses !== null) {
            $classEntity = $this->idSubClasses->getIdClass();

            if ($classEntity !== null) {
                return $classEntity->getName();
            }
        }

        return null;
    }

    public function getRaceName(): ?string
    {
        if ($this->idSubRace !== null) {
            $classEntity = $this->idSubRace->getIdRace();

            if ($classEntity !== null) {
                return $classEntity->getName();
            }
        }

        return null;
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
            $commentary->setBuild($this);
        }

        return $this;
    }

    public function removeCommentary(Commentaries $commentary): static
    {
        if ($this->commentaries->removeElement($commentary)) {
            // set the owning side to null (unless already changed)
            if ($commentary->getBuild() === $this) {
                $commentary->setBuild(null);
            }
        }

        return $this;
    }
}
