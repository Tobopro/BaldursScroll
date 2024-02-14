<?php

namespace App\Entity;

use App\Repository\SpellsLevelRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpellsLevelRepository::class)]
class SpellsLevel
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'spellsLevel', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Levels $idLevel = null;

    #[ORM\OneToOne(inversedBy: 'spellsLevel', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Spells $idSpell = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdLevel(): ?Levels
    {
        return $this->idLevel;
    }

    public function setIdLevel(Levels $idLevel): static
    {
        $this->idLevel = $idLevel;

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
}
