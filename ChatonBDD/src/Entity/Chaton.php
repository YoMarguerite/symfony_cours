<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ChatonRepository")
 */
class Chaton
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
     * @ORM\Column(type="string", length=200, nullable=true)
     * @Assert\Length(
     *  min = 0,
     *  max = 200,
     *  minMessage = "Le nom doit faire au moins {{ limit }} caractères de long",
     *  maxMessage = "Le nom doit faire au plus {{ limit }} caractères de long"
     * )
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categorie", inversedBy="chatons")
     * @ORM\JoinColumn(nullable=false)
     */
    private $categorie;

    /**
     * @ORM\Column(type="string")
     * 
     * @Assert\NotBlank(message="Choisissez une image pour votre chaton")
     * @Assert\File(mimeTypes={ "image/*" })
     */
    private $photo;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Proprietaire", inversedBy="chatons")
     * @Assert\NotBlank(
     * message = "Ne laissez pas ce chaton sans propriétaire :("
     * )
     */
    private $proprietaire;

    public function __construct()
    {
        $this->proprietaire = new ArrayCollection();
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

    public function getCategorie(): ?Categorie
    {
        return $this->categorie;
    }

    public function setCategorie(?Categorie $categorie): self
    {
        $this->categorie = $categorie;

        return $this;
    }

    public function getPhoto(): ?string
    {
        return $this->photo;
    }

    public function setPhoto(string $photo): self
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * @return Collection|Proprietaire[]
     */
    public function getProprietaire(): Collection
    {
        return $this->proprietaire;
    }

    public function addProprietaire(Proprietaire $proprietaire): self
    {
        if (!$this->proprietaire->contains($proprietaire)) {
            $this->proprietaire[] = $proprietaire;
        }

        return $this;
    }

    public function removeProprietaire(Proprietaire $proprietaire): self
    {
        if ($this->proprietaire->contains($proprietaire)) {
            $this->proprietaire->removeElement($proprietaire);
        }

        return $this;
    }
}
