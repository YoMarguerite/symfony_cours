<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TrajetRepository")
 */
class Trajet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="time")
     */
    private $Duree;

    /**
     * @ORM\Column(type="float")
     */
    private $Distance;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aeroport", inversedBy="TrajetDepart")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Depart;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aeroport", inversedBy="TrajetArrivee")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Arrivee;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vol", mappedBy="Trajet", orphanRemoval=true)
     */
    private $Vols;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Reference;

    public function __construct()
    {
        $this->Vols = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDuree(): ?\DateTimeInterface
    {
        return $this->Duree;
    }

    public function setDuree(\DateTimeInterface $Duree): self
    {
        $this->Duree = $Duree;

        return $this;
    }

    public function getDistance(): ?float
    {
        return $this->Distance;
    }

    public function setDistance(float $Distance): self
    {
        $this->Distance = $Distance;

        return $this;
    }

    public function getDepart(): ?Aeroport
    {
        return $this->Depart;
    }

    public function setDepart(?Aeroport $Depart): self
    {
        $this->Depart = $Depart;

        return $this;
    }

    public function getArrivee(): ?Aeroport
    {
        return $this->Arrivee;
    }

    public function setArrivee(?Aeroport $Arrivee): self
    {
        $this->Arrivee = $Arrivee;

        return $this;
    }

    /**
     * @return Collection|Vol[]
     */
    public function getVols(): Collection
    {
        return $this->Vols;
    }

    public function addVol(Vol $vol): self
    {
        if (!$this->Vols->contains($vol)) {
            $this->Vols[] = $vol;
            $vol->setTrajet($this);
        }

        return $this;
    }

    public function removeVol(Vol $vol): self
    {
        if ($this->Vols->contains($vol)) {
            $this->Vols->removeElement($vol);
            // set the owning side to null (unless already changed)
            if ($vol->getTrajet() === $this) {
                $vol->setTrajet(null);
            }
        }

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->Reference;
    }

    public function setReference(string $Reference): self
    {
        $this->Reference = $Reference;

        return $this;
    }
}
