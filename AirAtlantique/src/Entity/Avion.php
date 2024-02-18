<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AvionRepository")
 */
class Avion
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
    private $Matricule;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Moteur;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $Kilometre;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Modele;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Type;

    /**
     * @ORM\Column(type="integer")
     */
    private $Passager;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Maintenance", mappedBy="Avion", orphanRemoval=true)
     */
    private $Maintenances;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Vol", mappedBy="Avion", orphanRemoval=true)
     */
    private $Vols;

    public function __construct()
    {
        $this->Maintenances = new ArrayCollection();
        $this->Vols = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->Matricule;
    }

    public function setMatricule(string $Matricule): self
    {
        $this->Matricule = $Matricule;

        return $this;
    }

    public function getMoteur(): ?string
    {
        return $this->Moteur;
    }

    public function setMoteur(string $Moteur): self
    {
        $this->Moteur = $Moteur;

        return $this;
    }

    public function getKilometre(): ?float
    {
        return $this->Kilometre;
    }

    public function setKilometre(?float $Kilometre): self
    {
        $this->Kilometre = $Kilometre;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->Modele;
    }

    public function setModele(string $Modele): self
    {
        $this->Modele = $Modele;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->Type;
    }

    public function setType(string $Type): self
    {
        $this->Type = $Type;

        return $this;
    }

    public function getPassager(): ?int
    {
        return $this->Passager;
    }

    public function setPassager(int $Passager): self
    {
        $this->Passager = $Passager;

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
            $maintenance->setAvion($this);
        }

        return $this;
    }

    public function removeMaintenance(Maintenance $maintenance): self
    {
        if ($this->Maintenances->contains($maintenance)) {
            $this->Maintenances->removeElement($maintenance);
            // set the owning side to null (unless already changed)
            if ($maintenance->getAvion() === $this) {
                $maintenance->setAvion(null);
            }
        }

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
            $vol->setAvion($this);
        }

        return $this;
    }

    public function removeVol(Vol $vol): self
    {
        if ($this->Vols->contains($vol)) {
            $this->Vols->removeElement($vol);
            // set the owning side to null (unless already changed)
            if ($vol->getAvion() === $this) {
                $vol->setAvion(null);
            }
        }

        return $this;
    }
}
