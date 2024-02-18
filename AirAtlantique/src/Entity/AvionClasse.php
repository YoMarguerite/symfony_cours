<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvionClasseRepository")
 */
class AvionClasse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Avion")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Avion;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Classe", inversedBy="avionClasses")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Classe;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $Passager;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAvion(): ?Avion
    {
        return $this->Avion;
    }

    public function setAvion(?Avion $Avion): self
    {
        $this->Avion = $Avion;

        return $this;
    }

    public function getClasse(): ?Classe
    {
        return $this->Classe;
    }

    public function setClasse(?Classe $Classe): self
    {
        $this->Classe = $Classe;

        return $this;
    }

    public function getPassager(): ?int
    {
        return $this->Passager;
    }

    public function setPassager(?int $Passager): self
    {
        $this->Passager = $Passager;

        return $this;
    }
}
