<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VolRepository")
 */
class Vol
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Trajet", inversedBy="Vols")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Trajet;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Avion", inversedBy="Vols")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Avion;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Depart;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Arrivee;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Employe", inversedBy="Vols")
     */
    private $Employes;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\TarifVol", mappedBy="Vol", orphanRemoval=true)
     */
    private $tarifVols;

    public function __construct()
    {
        $this->tarifVols = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTrajet(): ?Trajet
    {
        return $this->Trajet;
    }

    public function setTrajet(?Trajet $Trajet): self
    {
        $this->Trajet = $Trajet;

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

    public function getDepart(): ?\DateTimeInterface
    {
        return $this->Depart;
    }

    public function setDepart(\DateTimeInterface $Depart): self
    {
        $this->Depart = $Depart;

        return $this;
    }

    public function getArrivee(): ?\DateTimeInterface
    {
        return $this->Arrivee;
    }

    public function setArrivee(\DateTimeInterface $Arrivee): self
    {
        $this->Arrivee = $Arrivee;

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

    /**
     * @return Collection|TarifVol[]
     */
    public function getTarifVols(): Collection
    {
        return $this->tarifVols;
    }

    public function addTarifVol(TarifVol $tarifVol): self
    {
        if (!$this->tarifVols->contains($tarifVol)) {
            $this->tarifVols[] = $tarifVol;
            $tarifVol->setVol($this);
        }

        return $this;
    }

    public function removeTarifVol(TarifVol $tarifVol): self
    {
        if ($this->tarifVols->contains($tarifVol)) {
            $this->tarifVols->removeElement($tarifVol);
            // set the owning side to null (unless already changed)
            if ($tarifVol->getVol() === $this) {
                $tarifVol->setVol(null);
            }
        }

        return $this;
    }

    public function getPlacesRestantes()
    {
        $somme = 0;
        foreach($this->tarifVols as $tarif){
            $somme += $tarif->getBillets()->count();
        }
        return $this->Avion->getPassager() - $somme;        
    }
}
