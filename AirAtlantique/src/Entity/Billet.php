<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BilletRepository")
 */
class Billet
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="Billets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $User;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\TarifVol", inversedBy="Billets")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Vol;

    /**
     * @ORM\Column(type="datetime")
     */
    private $Date;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?Client
    {
        return $this->User;
    }

    public function setUser(?Client $User): self
    {
        $this->User = $User;

        return $this;
    }

    public function getVol(): ?TarifVol
    {
        return $this->Vol;
    }

    public function setVol(?TarifVol $Vol): self
    {
        $this->Vol = $Vol;

        return $this;
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
}
