<?php

namespace App\Entity;

use App\Repository\RacesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RacesRepository::class)]
class Races
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $name = null;

    #[ORM\OneToMany(targetEntity: SubRaces::class, mappedBy: 'idRace')]
    private Collection $subRaces;

    public function __construct()
    {
        $this->subRaces = new ArrayCollection();
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

    /**
     * @return Collection<int, SubRaces>
     */
    public function getSubRaces(): Collection
    {
        return $this->subRaces;
    }

    public function addSubRace(SubRaces $subRace): static
    {
        if (!$this->subRaces->contains($subRace)) {
            $this->subRaces->add($subRace);
            $subRace->setIdRace($this);
        }

        return $this;
    }

    public function removeSubRace(SubRaces $subRace): static
    {
        if ($this->subRaces->removeElement($subRace)) {
            // set the owning side to null (unless already changed)
            if ($subRace->getIdRace() === $this) {
                $subRace->setIdRace(null);
            }
        }

        return $this;
    }

   

    
}
