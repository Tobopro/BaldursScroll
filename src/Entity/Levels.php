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

    #[ORM\OneToMany(targetEntity: Characters::class, mappedBy: 'idLevel')]
    private Collection $characters;

    #[ORM\OneToMany(targetEntity: ClassesSpells::class, mappedBy: 'idLevel', orphanRemoval: true)]
    private Collection $classesSpells;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
        $this->classesSpells = new ArrayCollection();
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

    /**
     * @return Collection<int, ClassesSpells>
     */
    public function getClassesSpells(): Collection
    {
        return $this->classesSpells;
    }

    public function addClassesSpell(ClassesSpells $classesSpell): static
    {
        if (!$this->classesSpells->contains($classesSpell)) {
            $this->classesSpells->add($classesSpell);
            $classesSpell->setIdLevel($this);
        }

        return $this;
    }

    public function removeClassesSpell(ClassesSpells $classesSpell): static
    {
        if ($this->classesSpells->removeElement($classesSpell)) {
            // set the owning side to null (unless already changed)
            if ($classesSpell->getIdLevel() === $this) {
                $classesSpell->setIdLevel(null);
            }
        }

        return $this;
    }

   
    
}
