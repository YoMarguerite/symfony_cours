<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EmployeRepository")
 */
class Employe
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
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Mail;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $Mdp;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Civilite;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Poste;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Vol", mappedBy="Employes")
     */
    private $Vols;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Maintenance", mappedBy="Employes")
     */
    private $Maintenances;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Maintenance", mappedBy="Responsable")
     */
    private $Responsable;

    public function __construct()
    {
        $this->Vols = new ArrayCollection();
        $this->Maintenances = new ArrayCollection();
        $this->ResponsableMaintenances = new ArrayCollection();
        $this->Responsable = new ArrayCollection();
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

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(string $Mail): self
    {
        $this->Mail = $Mail;

        return $this;
    }

    public function getMdp(): ?string
    {
        return $this->Mdp;
    }

    public function setMdp(string $Mdp): self
    {
        $this->Mdp = $Mdp;

        return $this;
    }

    public function getCivilite(): ?bool
    {
        return $this->Civilite;
    }

    public function setCivilite(bool $Civilite): self
    {
        $this->Civilite = $Civilite;

        return $this;
    }

    public function getPoste(): ?string
    {
        return $this->Poste;
    }

    public function setPoste(string $Poste): self
    {
        $this->Poste = $Poste;

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
            $vol->addEmploye($this);
        }

        return $this;
    }

    public function removeVol(Vol $vol): self
    {
        if ($this->Vols->contains($vol)) {
            $this->Vols->removeElement($vol);
            $vol->removeEmploye($this);
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
            $maintenance->addEmploye($this);
        }

        return $this;
    }

    public function removeMaintenance(Maintenance $maintenance): self
    {
        if ($this->Maintenances->contains($maintenance)) {
            $this->Maintenances->removeElement($maintenance);
            $maintenance->removeEmploye($this);
        }

        return $this;
    }

    /**
     * @return Collection|Maintenance[]
     */
    public function getResponsable(): Collection
    {
        return $this->Responsable;
    }

    public function addResponsable(Maintenance $responsable): self
    {
        if (!$this->Responsable->contains($responsable)) {
            $this->Responsable[] = $responsable;
            $responsable->setResponsable($this);
        }

        return $this;
    }

    public function removeResponsable(Maintenance $responsable): self
    {
        if ($this->Responsable->contains($responsable)) {
            $this->Responsable->removeElement($responsable);
            // set the owning side to null (unless already changed)
            if ($responsable->getResponsable() === $this) {
                $responsable->setResponsable(null);
            }
        }

        return $this;
    }
}
