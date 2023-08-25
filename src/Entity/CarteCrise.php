<?php

namespace App\Entity;

use App\Repository\CarteCriseRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CarteCriseRepository::class)]
class CarteCrise
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $noms = null;

    #[ORM\Column(length: 255)]
    private ?string $adresse = null;

    #[ORM\Column(length: 255)]
    private ?string $numImpot = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateMiseCirculation = null;

    #[ORM\Column(length: 255)]
    private ?string $typeUsage = null;

    #[ORM\ManyToOne(inversedBy: 'carteCrises')]
    private ?Detenteur $numPlaque = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDelivrance = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNoms(): ?string
    {
        return $this->noms;
    }

    public function setNoms(string $noms): static
    {
        $this->noms = $noms;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): static
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getNumImpot(): ?string
    {
        return $this->numImpot;
    }

    public function setNumImpot(string $numImpot): static
    {
        $this->numImpot = $numImpot;

        return $this;
    }

    public function getDateMiseCirculation(): ?\DateTimeInterface
    {
        return $this->dateMiseCirculation;
    }

    public function setDateMiseCirculation(\DateTimeInterface $dateMiseCirculation): static
    {
        $this->dateMiseCirculation = $dateMiseCirculation;

        return $this;
    }

    public function getTypeUsage(): ?string
    {
        return $this->typeUsage;
    }

    public function setTypeUsage(string $typeUsage): static
    {
        $this->typeUsage = $typeUsage;

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

    public function getDateDelivrance(): ?\DateTimeInterface
    {
        return $this->dateDelivrance;
    }

    public function setDateDelivrance(\DateTimeInterface $dateDelivrance): static
    {
        $this->dateDelivrance = $dateDelivrance;

        return $this;
    }
}
