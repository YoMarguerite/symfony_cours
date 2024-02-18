<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\VilleRepository")
 */
class Ville
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $Pays;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Aeroport", mappedBy="Ville")
     */
    private $Aeroports;

    public function __construct()
    {
        $this->Aeroports = new ArrayCollection();
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

    public function getPays(): ?string
    {
        return $this->Pays;
    }

    public function setPays(string $Pays): self
    {
        $this->Pays = $Pays;

        return $this;
    }

    /**
     * @return Collection|Aeroport[]
     */
    public function getAeroports(): Collection
    {
        return $this->Aeroports;
    }

    public function addAeroport(Aeroport $aeroport): self
    {
        if (!$this->Aeroports->contains($aeroport)) {
            $this->Aeroports[] = $aeroport;
            $aeroport->setVille($this);
        }

        return $this;
    }

    public function removeAeroport(Aeroport $aeroport): self
    {
        if ($this->Aeroports->contains($aeroport)) {
            $this->Aeroports->removeElement($aeroport);
            // set the owning side to null (unless already changed)
            if ($aeroport->getVille() === $this) {
                $aeroport->setVille(null);
            }
        }

        return $this;
    }
}
