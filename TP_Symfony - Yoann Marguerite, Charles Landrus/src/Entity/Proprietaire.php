<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProprietaireRepository")
 */
class Proprietaire
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank()
     * @Assert\Length(
     *  min = 2,
     *  max = 30,
     *  minMessage = "Le nom doit faire au moins {{ limit }} caractères de long",
     *  maxMessage = "Le nom doit faire au plus {{ limit }} caractères de long"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=30)
     * @Assert\NotBlank()
     * @Assert\Length(
     *  min = 2,
     *  max = 30,
     *  minMessage = "Le nom doit faire au moins {{ limit }} caractères de long",
     *  maxMessage = "Le nom doit faire au plus {{ limit }} caractères de long"
     * )
     */
    private $prenom;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Chaton", mappedBy="proprietaire")
     */
    private $chatons;

    public function __construct()
    {
        $this->chatons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNomEntier(): ?string
    {
        $nom_entier = $this->prenom." ".$this->nom;

        return $nom_entier;
    }

    /**
     * @return Collection|Chaton[]
     */
    public function getChatons(): Collection
    {
        return $this->chatons;
    }

    public function getnbChatons(): int
    {
        return count($this->chatons);
    }

    public function addChaton(Chaton $chaton): self
    {
        if (!$this->chatons->contains($chaton)) {
            $this->chatons[] = $chaton;
            $chaton->addProprietaire($this);
        }

        return $this;
    }

    public function removeChaton(Chaton $chaton): self
    {
        if ($this->chatons->contains($chaton)) {
            $this->chatons->removeElement($chaton);
            $chaton->removeProprietaire($this);
        }

        return $this;
    }
}
