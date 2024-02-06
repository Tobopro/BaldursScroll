<?php

namespace App\Entity;

use App\Repository\SubClassesRepository;
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
}
