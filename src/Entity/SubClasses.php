<?php

namespace App\Entity;

use App\Repository\SubClassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SubClassesRepository::class)]
class SubClasses
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 30)]
    private ?string $name = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $icon = null;

    #[ORM\ManyToOne(inversedBy: 'subClasses')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Classes $idClass = null;

    #[ORM\OneToMany(targetEntity: Characteres::class, mappedBy: 'idSubClasses')]
    private Collection $characteres;

    #[ORM\OneToOne(mappedBy: 'idSubClasses', cascade: ['persist', 'remove'])]
    private ?ClassesSpells $classesSpells = null;

    public function __construct()
    {
        $this->characteres = new ArrayCollection();
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

    public function getIcon(): ?string
    {
        return $this->icon;
    }

    public function setIcon(?string $icon): static
    {
        $this->icon = $icon;

        return $this;
    }

    public function getIdClass(): ?Classes
    {
        return $this->idClass;
    }

    public function setIdClass(?Classes $idClass): static
    {
        $this->idClass = $idClass;

        return $this;
    }

    /**
     * @return Collection<int, Characteres>
     */
    public function getCharacteres(): Collection
    {
        return $this->characteres;
    }

    public function addCharactere(Characteres $charactere): static
    {
        if (!$this->characteres->contains($charactere)) {
            $this->characteres->add($charactere);
            $charactere->setIdSubClasses($this);
        }

        return $this;
    }

    public function removeCharactere(Characteres $charactere): static
    {
        if ($this->characteres->removeElement($charactere)) {
            // set the owning side to null (unless already changed)
            if ($charactere->getIdSubClasses() === $this) {
                $charactere->setIdSubClasses(null);
            }
        }

        return $this;
    }

    public function getClassesSpells(): ?ClassesSpells
    {
        return $this->classesSpells;
    }

    public function setClassesSpells(ClassesSpells $classesSpells): static
    {
        // set the owning side of the relation if necessary
        if ($classesSpells->getIdSubClasses() !== $this) {
            $classesSpells->setIdSubClasses($this);
        }

        $this->classesSpells = $classesSpells;

        return $this;
    }
}
