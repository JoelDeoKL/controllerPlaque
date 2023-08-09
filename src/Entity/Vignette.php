<?php

namespace App\Entity;

use App\Repository\VignetteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VignetteRepository::class)]
class Vignette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $code = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column]
    private ?int $montantImpot = null;

    #[ORM\Column]
    private ?int $taxe = null;

    #[ORM\Column(length: 255)]
    private ?string $reference = null;

    #[ORM\ManyToOne(inversedBy: 'vignettes')]
    private ?Detenteur $numPlaque = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): static
    {
        $this->code = $code;

        return $this;
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

    public function getMontantImpot(): ?int
    {
        return $this->montantImpot;
    }

    public function setMontantImpot(int $montantImpot): static
    {
        $this->montantImpot = $montantImpot;

        return $this;
    }

    public function getTaxe(): ?int
    {
        return $this->taxe;
    }

    public function setTaxe(int $taxe): static
    {
        $this->taxe = $taxe;

        return $this;
    }

    public function getReference(): ?string
    {
        return $this->reference;
    }

    public function setReference(string $reference): static
    {
        $this->reference = $reference;

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


    
}
