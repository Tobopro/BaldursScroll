<?php

namespace App\Entity;

use App\Repository\LevelsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevelsRepository::class)]
class Levels
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $level = null;

    #[ORM\OneToOne(mappedBy: 'idLevel', cascade: ['persist', 'remove'])]
    private ?RacesSpells $racesSpells = null;

    #[ORM\OneToOne(mappedBy: 'idLevel', cascade: ['persist', 'remove'])]
    private ?SpellsLevel $spellsLevel = null;

    #[ORM\ManyToOne(inversedBy: 'idLevel')]
    #[ORM\JoinColumn(nullable: false)]
    private ?ClassesSpells $classesSpells = null;

    #[ORM\OneToMany(targetEntity: Characters::class, mappedBy: 'idLevel')]
    private Collection $characters;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
    }

    

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): static
    {
        $this->level = $level;

        return $this;
    }

    public function getRacesSpells(): ?RacesSpells
    {
        return $this->racesSpells;
    }

    public function setRacesSpells(RacesSpells $racesSpells): static
    {
        // set the owning side of the relation if necessary
        if ($racesSpells->getIdLevel() !== $this) {
            $racesSpells->setIdLevel($this);
        }

        $this->racesSpells = $racesSpells;

        return $this;
    }

    public function getSpellsLevel(): ?SpellsLevel
    {
        return $this->spellsLevel;
    }

    public function setSpellsLevel(SpellsLevel $spellsLevel): static
    {
        // set the owning side of the relation if necessary
        if ($spellsLevel->getIdLevel() !== $this) {
            $spellsLevel->setIdLevel($this);
        }

        $this->spellsLevel = $spellsLevel;

        return $this;
    }

    public function getClassesSpells(): ?ClassesSpells
    {
        return $this->classesSpells;
    }

    public function setClassesSpells(?ClassesSpells $classesSpells): static
    {
        $this->classesSpells = $classesSpells;

        return $this;
    }

    /**
     * @return Collection<int, Characters>
     */
    public function getCharacters(): Collection
    {
        return $this->characters;
    }

    public function addCharacter(Characters $character): static
    {
        if (!$this->characters->contains($character)) {
            $this->characters->add($character);
            $character->setIdLevel($this);
        }

        return $this;
    }

    public function removeCharacter(Characters $character): static
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getIdLevel() === $this) {
                $character->setIdLevel(null);
            }
        }

        return $this;
    }

   
    
}
