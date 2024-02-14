<?php

namespace App\Entity;

use App\Repository\ClassesSpellsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassesSpellsRepository::class)]
class ClassesSpells
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'classesSpells', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?SubClasses $idSubClasses = null;

    #[ORM\OneToOne(inversedBy: 'classesSpells', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Spells $idSpell = null;

    #[ORM\OneToMany(targetEntity: Levels::class, mappedBy: 'classesSpells')]
    private Collection $idLevel;

    public function __construct()
    {
        $this->idLevel = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdSubClasses(): ?SubClasses
    {
        return $this->idSubClasses;
    }

    public function setIdSubClasses(SubClasses $idSubClasses): static
    {
        $this->idSubClasses = $idSubClasses;

        return $this;
    }

    public function getIdSpell(): ?Spells
    {
        return $this->idSpell;
    }

    public function setIdSpell(Spells $idSpell): static
    {
        $this->idSpell = $idSpell;

        return $this;
    }

    /**
     * @return Collection<int, Levels>
     */
    public function getIdLevel(): Collection
    {
        return $this->idLevel;
    }

    public function addIdLevel(Levels $idLevel): static
    {
        if (!$this->idLevel->contains($idLevel)) {
            $this->idLevel->add($idLevel);
            $idLevel->setClassesSpells($this);
        }

        return $this;
    }

    public function removeIdLevel(Levels $idLevel): static
    {
        if ($this->idLevel->removeElement($idLevel)) {
            // set the owning side to null (unless already changed)
            if ($idLevel->getClassesSpells() === $this) {
                $idLevel->setClassesSpells(null);
            }
        }

        return $this;
    }
}
