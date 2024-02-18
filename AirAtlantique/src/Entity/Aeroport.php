<?php

namespace App\Entity;

use App\Entity\Ville;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AeroportRepository")
 */
class Aeroport
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
    private $Nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $AITA;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trajet", mappedBy="Depart", orphanRemoval=true)
     */
    private $TrajetDepart;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Trajet", mappedBy="Arrivee", orphanRemoval=true)
     */
    private $TrajetArrivee;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Maintenance", mappedBy="Aeroport", orphanRemoval=true)
     */
    private $Maintenances;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Ville", inversedBy="Aeroports")
     * @ORM\JoinColumn(nullable=true)
     */
    private $Ville;

    public function __construct()
    {
        $this->TrajetDepart = new ArrayCollection();
        $this->TrajetArrivee = new ArrayCollection();
        $this->Maintenances = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getAITA(): ?string
    {
        return $this->AITA;
    }

    public function setAITA(string $AITA): self
    {
        $this->AITA = $AITA;

        return $this;
    }

    /**
     * @return Collection|Trajet[]
     */
    public function getTrajetDepart(): Collection
    {
        return $this->TrajetDepart;
    }

    public function addTrajetDepart(Trajet $trajetDepart): self
    {
        if (!$this->TrajetDepart->contains($trajetDepart)) {
            $this->TrajetDepart[] = $trajetDepart;
            $trajetDepart->setDepart($this);
        }

        return $this;
    }

    public function removeTrajetDepart(Trajet $trajetDepart): self
    {
        if ($this->TrajetDepart->contains($trajetDepart)) {
            $this->TrajetDepart->removeElement($trajetDepart);
            // set the owning side to null (unless already changed)
            if ($trajetDepart->getDepart() === $this) {
                $trajetDepart->setDepart(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Trajet[]
     */
    public function getTrajetArrivee(): Collection
    {
        return $this->TrajetArrivee;
    }

    public function addTrajetArrivee(Trajet $trajetArrivee): self
    {
        if (!$this->TrajetArrivee->contains($trajetArrivee)) {
            $this->TrajetArrivee[] = $trajetArrivee;
            $trajetArrivee->setArrivee($this);
        }

        return $this;
    }

    public function removeTrajetArrivee(Trajet $trajetArrivee): self
    {
        if ($this->TrajetArrivee->contains($trajetArrivee)) {
            $this->TrajetArrivee->removeElement($trajetArrivee);
            // set the owning side to null (unless already changed)
            if ($trajetArrivee->getArrivee() === $this) {
                $trajetArrivee->setArrivee(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Maintenance[]
     */
    public function getMaintenances(): Collection
    {
        return $this->Maintenances;
    }

    public function addMaintenance(Maintenance $maintenance): self
    {
        if (!$this->Maintenances->contains($maintenance)) {
            $this->Maintenances[] = $maintenance;
            $maintenance->setAeroport($this);
        }

        return $this;
    }

    public function removeMaintenance(Maintenance $maintenance): self
    {
        if ($this->Maintenances->contains($maintenance)) {
            $this->Maintenances->removeElement($maintenance);
            // set the owning side to null (unless already changed)
            if ($maintenance->getAeroport() === $this) {
                $maintenance->setAeroport(null);
            }
        }

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->Ville;
    }

    public function setVille(?Ville $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }
}
