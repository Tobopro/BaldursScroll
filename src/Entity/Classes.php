<?php

namespace App\Entity;

use App\Repository\ClassesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ClassesRepository::class)]
class Classes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 20)]
    private ?string $name = null;

    #[ORM\Column]
    private ?int $startingHp = null;

    #[ORM\Column]
    private ?int $onLevelUpHp = null;

    #[ORM\Column(length: 50)]
    private ?string $savingThrowProficency1 = null;

    #[ORM\Column(length: 50)]
    private ?string $savingThrowProficency2 = null;

    #[ORM\OneToMany(targetEntity: SubClasses::class, mappedBy: 'idClass')]
    private Collection $subClasses;

    public function __construct()
    {
        $this->subClasses = new ArrayCollection();
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

    public function getStartingHp(): ?int
    {
        return $this->startingHp;
    }

    public function setStartingHp(int $startingHp): static
    {
        $this->startingHp = $startingHp;

        return $this;
    }

    public function getOnLevelUpHp(): ?int
    {
        return $this->onLevelUpHp;
    }

    public function setOnLevelUpHp(int $onLevelUpHp): static
    {
        $this->onLevelUpHp = $onLevelUpHp;

        return $this;
    }

    public function getSavingThrowProficency1(): ?string
    {
        return $this->savingThrowProficency1;
    }

    public function setSavingThrowProficency1(string $savingThrowProficency1): static
    {
        $this->savingThrowProficency1 = $savingThrowProficency1;

        return $this;
    }

    public function getSavingThrowProficency2(): ?string
    {
        return $this->savingThrowProficency2;
    }

    public function setSavingThrowProficency2(string $savingThrowProficency2): static
    {
        $this->savingThrowProficency2 = $savingThrowProficency2;

        return $this;
    }

    /**
     * @return Collection<int, SubClasses>
     */
    public function getSubClasses(): Collection
    {
        return $this->subClasses;
    }

    public function addSubClass(SubClasses $subClass): static
    {
        if (!$this->subClasses->contains($subClass)) {
            $this->subClasses->add($subClass);
            $subClass->setIdClass($this);
        }

        return $this;
    }

    public function removeSubClass(SubClasses $subClass): static
    {
        if ($this->subClasses->removeElement($subClass)) {
            // set the owning side to null (unless already changed)
            if ($subClass->getIdClass() === $this) {
                $subClass->setIdClass(null);
            }
        }

        return $this;
    }
}
