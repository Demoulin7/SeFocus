<?php

namespace App\Entity;

use App\Repository\DonneesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DonneesRepository::class)]
class Donnees
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $nbTiragesT = null;

    #[ORM\Column]
    private ?int $nbPomodoroT = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNbTiragesT(): ?int
    {
        return $this->nbTiragesT;
    }

    public function setNbTiragesT(int $nbTiragesT): self
    {
        $this->nbTiragesT = $nbTiragesT;

        return $this;
    }

    public function getNbPomodoroT(): ?int
    {
        return $this->nbPomodoroT;
    }

    public function setNbPomodoroT(int $nbPomodoroT): self
    {
        $this->nbPomodoroT = $nbPomodoroT;

        return $this;
    }
}
