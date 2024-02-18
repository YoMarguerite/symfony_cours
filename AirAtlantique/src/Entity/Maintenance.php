<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MaintenanceRepository")
 */
class Maintenance
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $Date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Avion", inversedBy="Maintenances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Avion;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Employe", inversedBy="Maintenances")
     */
    private $Employes;

    /**
     * @ORM\Column(type="text")
     */
    private $Details;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Aeroport", inversedBy="Maintenances")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Aeroport;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Employe", inversedBy="Responsable")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Responsable;

    public function __construct()
    {
        $this->Employes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->Date;
    }

    public function setDate(\DateTimeInterface $Date): self
    {
        $this->Date = $Date;

        return $this;
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

    /**
     * @return Collection|Employe[]
     */
    public function getEmployes(): Collection
    {
        return $this->Employes;
    }

    public function addEmploye(Employe $employe): self
    {
        if (!$this->Employes->contains($employe)) {
            $this->Employes[] = $employe;
        }

        return $this;
    }

    public function removeEmploye(Employe $employe): self
    {
        if ($this->Employes->contains($employe)) {
            $this->Employes->removeElement($employe);
        }

        return $this;
    }

    public function getDetails(): ?string
    {
        return $this->Details;
    }

    public function setDetails(string $Details): self
    {
        $this->Details = $Details;

        return $this;
    }

    public function getAeroport(): ?Aeroport
    {
        return $this->Aeroport;
    }

    public function setAeroport(?Aeroport $Aeroport): self
    {
        $this->Aeroport = $Aeroport;

        return $this;
    }

    public function getResponsable(): ?Employe
    {
        return $this->Responsable;
    }

    public function setResponsable(?Employe $Responsable): self
    {
        $this->Responsable = $Responsable;

        return $this;
    }
}
