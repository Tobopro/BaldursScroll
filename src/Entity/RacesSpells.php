<?php

namespace App\Entity;

use App\Repository\RacesSpellsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RacesSpellsRepository::class)]
class RacesSpells
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\OneToOne(inversedBy: 'racesSpells', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?Levels $idLevel = null;

    #[ORM\OneToOne(inversedBy: 'racesSpells', cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?SubRaces $idSubRace = null;

    #[ORM\ManyToOne(inversedBy: 'racesSpells')]
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

    public function getIdSubRace(): ?SubRaces
    {
        return $this->idSubRace;
    }

    public function setIdSubRace(SubRaces $idSubRace): static
    {
        $this->idSubRace = $idSubRace;

        return $this;
    }

    public function getIdSpell(): ?Spells
    {
        return $this->idSpell;
    }

    public function setIdSpell(?Spells $idSpell): static
    {
        $this->idSpell = $idSpell;

        return $this;
    }
}
