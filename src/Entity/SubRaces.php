<?php

namespace App\Entity;

use App\Repository\SubRacesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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

    #[ORM\OneToMany(targetEntity: Characters::class, mappedBy: 'idSubRace')]
    private Collection $characters;

    #[ORM\OneToOne(mappedBy: 'idSubRace', cascade: ['persist', 'remove'])]
    private ?RacesSpells $racesSpells = null;

    public function __construct()
    {
        $this->characters = new ArrayCollection();
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

    /**
     * @return Collection<int, characters>
     */
    public function getcharacters(): Collection
    {
        return $this->characters;
    }

    public function addcharacter(Characters $character): static
    {
        if (!$this->characters->contains($character)) {
            $this->characters->add($character);
            $character->setIdSubRace($this);
        }

        return $this;
    }

    public function removecharacter(Characters $character): static
    {
        if ($this->characters->removeElement($character)) {
            // set the owning side to null (unless already changed)
            if ($character->getIdSubRace() === $this) {
                $character->setIdSubRace(null);
            }
        }

        return $this;
    }

    public function getRacesSpells(): ?RacesSpells
    {
        return $this->racesSpells;
    }

    public function setRacesSpells(RacesSpells $racesSpells): static
    {
        // set the owning side of the relation if necessary
        if ($racesSpells->getIdSubRace() !== $this) {
            $racesSpells->setIdSubRace($this);
        }

        $this->racesSpells = $racesSpells;

        return $this;
    }
}
