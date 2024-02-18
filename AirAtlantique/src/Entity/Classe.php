<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClasseRepository")
 */
class Classe
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Classe;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Tarif", mappedBy="Classe", orphanRemoval=true)
     */
    private $Tarif;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\AvionClasse", mappedBy="Classe", orphanRemoval=true)
     */
    private $avionClasses;

    public function __construct()
    {
        $this->Tarif = new ArrayCollection();
        $this->avionClasses = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClasse(): ?string
    {
        return $this->Classe;
    }

    public function setClasse(string $Classe): self
    {
        $this->Classe = $Classe;

        return $this;
    }

    /**
     * @return Collection|Tarif[]
     */
    public function getTarif(): Collection
    {
        return $this->Tarif;
    }

    public function addTarif(Tarif $tarif): self
    {
        if (!$this->Tarif->contains($tarif)) {
            $this->Tarif[] = $tarif;
            $tarif->setClasse($this);
        }

        return $this;
    }

    public function removeTarif(Tarif $tarif): self
    {
        if ($this->Tarif->contains($tarif)) {
            $this->Tarif->removeElement($tarif);
            // set the owning side to null (unless already changed)
            if ($tarif->getClasse() === $this) {
                $tarif->setClasse(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|AvionClasse[]
     */
    public function getAvionClasses(): Collection
    {
        return $this->avionClasses;
    }

    public function addAvionClass(AvionClasse $avionClass): self
    {
        if (!$this->avionClasses->contains($avionClass)) {
            $this->avionClasses[] = $avionClass;
            $avionClass->setClasse($this);
        }

        return $this;
    }

    public function removeAvionClass(AvionClasse $avionClass): self
    {
        if ($this->avionClasses->contains($avionClass)) {
            $this->avionClasses->removeElement($avionClass);
            // set the owning side to null (unless already changed)
            if ($avionClass->getClasse() === $this) {
                $avionClass->setClasse(null);
            }
        }

        return $this;
    }
}
