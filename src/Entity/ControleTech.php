<?php

namespace App\Entity;

use App\Repository\ControleTechRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ControleTechRepository::class)]
class ControleTech
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[ORM\Column(length: 255)]
    private ?string $miseCirculation = null;

    #[ORM\ManyToOne(inversedBy: 'controleTeches')]
    private ?Detenteur $numPlaque = null;

    #[ORM\Column(length: 255)]
    private ?string $numChassis = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_delivrance = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_expiration = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): static
    {
        $this->marque = $marque;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): static
    {
        $this->modele = $modele;

        return $this;
    }

    public function getMiseCirculation(): ?string
    {
        return $this->miseCirculation;
    }

    public function setMiseCirculation(string $miseCirculation): static
    {
        $this->miseCirculation = $miseCirculation;

        return $this;
    }

    public function getNumPlaque(): ?Detenteur
    {
        return $this->numPlaque;
    }

    public function setNumPlaque(?Detenteur $numPlaque): static
    {
        $this->numPlaque = $numPlaque;

        return $this;
    }

    public function getNumChassis(): ?string
    {
        return $this->numChassis;
    }

    public function setNumChassis(string $numChassis): static
    {
        $this->numChassis = $numChassis;

        return $this;
    }

    public function getDateDelivrance(): ?\DateTimeInterface
    {
        return $this->date_delivrance;
    }

    public function setDateDelivrance(\DateTimeInterface $date_delivrance): static
    {
        $this->date_delivrance = $date_delivrance;

        return $this;
    }

    public function getDateExpiration(): ?\DateTimeInterface
    {
        return $this->date_expiration;
    }

    public function setDateExpiration(\DateTimeInterface $date_expiration): static
    {
        $this->date_expiration = $date_expiration;

        return $this;
    }
}
