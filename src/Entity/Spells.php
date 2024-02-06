<?php

namespace App\Entity;

use App\Repository\SpellsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SpellsRepository::class)]
class Spells
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $damageType = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $damageRoll = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $icon = null;

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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getDamageType(): ?string
    {
        return $this->damageType;
    }

    public function setDamageType(?string $damageType): static
    {
        $this->damageType = $damageType;

        return $this;
    }

    public function getDamageRoll(): ?string
    {
        return $this->damageRoll;
    }

    public function setDamageRoll(?string $damageRoll): static
    {
        $this->damageRoll = $damageRoll;

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
}
