<?php

namespace App\Entity;

use App\Repository\ClassesSpellsRepository;
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

    #[ORM\OneToOne(inversedBy: 'classesSpells')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Spells $idSpell = null;

    #[ORM\ManyToOne(inversedBy: 'classesSpells')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Levels $idLevel = null;

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

    public function getIdLevel(): ?Levels
    {
        return $this->idLevel;
    }

    public function setIdLevel(?Levels $idLevel): static
    {
        $this->idLevel = $idLevel;

        return $this;
    }
}
