<?php

namespace App\Entity;

use App\Repository\CharactersRepository;
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
    private ?string $abilityScoreBonus1 = null;

    #[ORM\Column(length: 20)]
    private ?string $abilityScoreBonus2 = null;

    #[ORM\ManyToOne(inversedBy: 'characteres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SubRaces $idSubRace = null;

    #[ORM\ManyToOne(inversedBy: 'characteres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?SubClasses $idSubClasses = null;

    #[ORM\ManyToOne(inversedBy: 'characteres')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Users $idUsers = null;

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

    public function getAbilityScoreBonnus1(): ?string
    {
        return $this->abilityScoreBonus1;
    }

    public function setAbilityScoreBonnus1(string $abilityScoreBonnus1): static
    {
        $this->abilityScoreBonus1 = $abilityScoreBonnus1;

        return $this;
    }

    public function getAbilityScoreBonnus2(): ?string
    {
        return $this->abilityScoreBonus2;
    }

    public function setAbilityScoreBonnus2(string $abilityScoreBonnus2): static
    {
        $this->abilityScoreBonus2 = $abilityScoreBonnus2;

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

    public function getIdUsers(): ?Users
    {
        return $this->idUsers;
    }

    public function setIdUsers(?Users $idUsers): static
    {
        $this->idUsers = $idUsers;

        return $this;
    }
}
