<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategorieRepository")
 */
class Categorie
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     * @Assert\NotBlank()
     * @Assert\Length(
     *  min = 2,
     *  max = 20,
     *  minMessage = "Le nom doit faire au moins {{ limit }} caractères de long",
     *  maxMessage = "Le nom doit faire au plus {{ limit }} caractères de long"
     * )
     */
    private $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Chaton", mappedBy="categorie", orphanRemoval=true)
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Chaton[]
     */
    public function getChatons(): Collection
    {
        return $this->chatons;
    }

    public function addChaton(Chaton $chaton): self
    {
        if (!$this->chatons->contains($chaton)) {
            $this->chatons[] = $chaton;
            $chaton->setCategorie($this);
        }

        return $this;
    }

    public function removeChaton(Chaton $chaton): self
    {
        if ($this->chatons->contains($chaton)) {
            $this->chatons->removeElement($chaton);
            // set the owning side to null (unless already changed)
            if ($chaton->getCategorie() === $this) {
                $chaton->setCategorie(null);
            }
        }

        return $this;
    }
}
