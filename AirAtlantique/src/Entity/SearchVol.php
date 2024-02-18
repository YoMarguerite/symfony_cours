<?php

namespace App\Entity;

use App\Entity\Ville;
use App\Entity\Classe;
use App\Entity\Trajet;
use Symfony\Component\Validator\Constraints as Assert;

class SearchVol
{
    private $Date;

    private $Depart;

    /**
     * @Assert\NotEqualTo(propertyPath="Depart", message="Les Villes choisies doivent être différentes.")
     */
    private $Arrivee;

    private $Trajet;

    public function __construct()
    {
        
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

    public function getDepart(): ?Ville
    {
        return $this->Depart;
    }

    public function setDepart(Ville $Depart): self
    {
        $this->Depart = $Depart;
        return $this;
    }

    public function getArrivee(): ?Ville
    {
        return $this->Arrivee;
    }

    public function setArrivee(Ville $Arrivee): self
    {
        $this->Arrivee = $Arrivee;
        return $this;
    }

    public function getTrajet(): ?Trajet
    {
        return $this->Trajet;
    }

    public function setTrajet(Trajet $Trajet): self
    {
        $this->Trajet = $Trajet;
        return $this;
    }
}
