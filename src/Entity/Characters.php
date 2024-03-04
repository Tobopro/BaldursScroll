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

    private ?Races $idRaces = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: true)]
    private ?SubClasses $idSubClasses = null;

    private ?Classes $idClasses = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $idUsers = null;

    #[ORM\ManyToOne(inversedBy: 'characters')]
    private ?Levels $idLevel = null;

    #[ORM\OneToMany(targetEntity: Commentaries::class, mappedBy: 'Build')]
    private Collection $commentaries;

    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'liked')]
    private Collection $liked;

    #[ORM\Column]
    private ?bool $isPublic = null;

    #[ORM\Column(options: ["default" => 0])]
    private ?bool $IsFlaged = false;

    public function __construct()
    {
        $this->strength = 8;
        $this->dexterity = 8;
        $this->constitution = 8;
        $this->intelligence = 8;
        $this->wisdom = 8;
        $this->charisma = 8;
        $this->commentaries = new ArrayCollection();
        $this->idClasses = $this->setClassWithSubClass();
        $this->idRaces = $this->setRaceWithSubRace();
        $this->liked = new ArrayCollection();
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

    public function getIdClasses(): ?Classes
    {
        return $this->idClasses;
    }

    public function setIdClasses(?Classes $class): static
    {
        $this->idClasses = $class;

        return $this;
    }

    public function setClassWithSubClass(): ?Characters
    {
        if ($this->idSubClasses !== null) {
            $this->setIdClasses($this->idSubClasses->getIdClass());
            return $this;
        } else {
            return null;
        }
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

    public function getIdRaces(): ?Races
    {
        return $this->idRaces;
    }

    public function setIdRaces(?Races $race): static
    {
        $this->idRaces = $race;

        return $this;
    }

    public function setRaceWithSubRace(): ?Characters
    {
        if ($this->idSubRace !== null) {
            $this->setIdRaces($this->idSubRace->getIdRace());
            return $this;
        } else {
            return null;
        }
    }

    public function getRaceName(): ?string
    {
        if ($this->idSubRace !== null) {
            $raceEntity = $this->idSubRace->getIdRace();

            if ($raceEntity !== null) {
                return $raceEntity->getName();
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

    /**
     * @return Collection<int, User>
     */

    public function getLikes(): int
    {
        return $this->liked->count();
    }
    public function getLiked(): Collection
    {
        return $this->liked;
    }

    public function addLiked(User $liked): static
    {
        if (!$this->liked->contains($liked)) {
            $this->liked->add($liked);
            $liked->addLiked($this);
        }

        return $this;
    }

    public function removeLiked(User $liked): static
    {
        if ($this->liked->removeElement($liked)) {
            $liked->removeLiked($this);
        }

        return $this;
    }

    public function isIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): static
    {
        $this->isPublic = $isPublic;

        return $this;
    }

    public function isIsFlaged(): ?bool
    {
        return $this->IsFlaged;
    }

    public function setIsFlaged(bool $IsFlaged): static
    {
        $this->IsFlaged = $IsFlaged;

        return $this;
    }
}
