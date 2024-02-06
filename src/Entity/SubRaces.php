<?php

namespace App\Entity;

use App\Repository\SubRacesRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubRacesRepository::class)]
class SubRaces
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 3, scale: 1)]
    private ?string $speed = null;

    #[ORM\ManyToOne(inversedBy: 'subRaces')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Races $idRace = null;

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

    public function getSpeed(): ?string
    {
        return $this->speed;
    }

    public function setSpeed(string $speed): static
    {
        $this->speed = $speed;

        return $this;
    }

    public function getIdRace(): ?Races
    {
        return $this->idRace;
    }

    public function setIdRace(?Races $idRace): static
    {
        $this->idRace = $idRace;

        return $this;
    }
}
