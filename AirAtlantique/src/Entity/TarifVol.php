<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\TarifVolRepository")
 */
class TarifVol
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="float")
     */
    private $Prix;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Vol", inversedBy="tarifVols")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Vol;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Tarif")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Tarif;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Billet", mappedBy="Vol", orphanRemoval=true)
     */
    private $Billets;

    public function __construct()
    {
        $this->Billets = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?float
    {
        return $this->Prix;
    }

    public function setPrix(float $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    public function getVol(): ?Vol
    {
        return $this->Vol;
    }

    public function setVol(?Vol $Vol): self
    {
        $this->Vol = $Vol;

        return $this;
    }

    public function getTarif(): ?Tarif
    {
        return $this->Tarif;
    }

    public function setTarif(?Tarif $Tarif): self
    {
        $this->Tarif = $Tarif;

        return $this;
    }

    /**
     * @return Collection|Billet[]
     */
    public function getBillets(): Collection
    {
        return $this->Billets;
    }

    public function addBillet(Billet $billet): self
    {
        if (!$this->Billets->contains($billet)) {
            $this->Billets[] = $billet;
            $billet->setVol($this);
        }

        return $this;
    }

    public function removeBillet(Billet $billet): self
    {
        if ($this->Billets->contains($billet)) {
            $this->Billets->removeElement($billet);
            // set the owning side to null (unless already changed)
            if ($billet->getVol() === $this) {
                $billet->setVol(null);
            }
        }

        return $this;
    }
}
