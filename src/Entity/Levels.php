<?php

namespace App\Entity;

use App\Repository\LevelsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LevelsRepository::class)]
class Levels
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $level = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLevel(): ?int
    {
        return $this->level;
    }

    public function setLevel(int $level): static
    {
        $this->level = $level;

        return $this;
    }
}
