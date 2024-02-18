<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClientRepository")
 * @UniqueEntity(
 *  fields= {"Mail"},
 *  message= "Le mail est déjà utilisé"
 * )
 */
class Client implements UserInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Email()
     */
    private $Mail;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $UserName;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $FirstName;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\Length(min="8", minMessage="Votre mot de passe doit faire minimum 8 caractères")
     */
    private $Password;


    /**
     * @Assert\EqualTo(propertyPath="Password", message="Le mot de passe ne corresponds pas")
     */
    public $ConfirmPassword;

    /**
     * @ORM\Column(type="boolean")
     */
    private $Civilite;

    /**
     * @ORM\Column(type="integer")
     */
    private $Fidelite;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Billet", mappedBy="User", orphanRemoval=true)
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

    public function getMail(): ?string
    {
        return $this->Mail;
    }

    public function setMail(string $Mail): self
    {
        $this->Mail = $Mail;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->UserName;
    }

    public function setUserName(string $UserName): self
    {
        $this->UserName = $UserName;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->FirstName;
    }

    public function setFirstName(string $FirstName): self
    {
        $this->FirstName = $FirstName;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->Password;
    }

    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    public function eraseCredentials(){

    }

    public function getSalt(){

    }

    public function getRoles(){
        return ['ROLE_USER'];
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

    public function getFidelite(): ?int
    {
        return $this->Fidelite;
    }

    public function setFidelite(int $Fidelite): self
    {
        $this->Fidelite = $Fidelite;

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
            $billet->setUser($this);
        }

        return $this;
    }

    public function removeBillet(Billet $billet): self
    {
        if ($this->Billets->contains($billet)) {
            $this->Billets->removeElement($billet);
            // set the owning side to null (unless already changed)
            if ($billet->getUser() === $this) {
                $billet->setUser(null);
            }
        }

        return $this;
    }
}
