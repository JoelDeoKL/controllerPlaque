<?php

namespace App\Entity;

use App\Repository\AssuranceRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AssuranceRepository::class)]
class Assurance
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $numAgreement = null;

    #[ORM\Column(length: 255)]
    private ?string $numPolice = null;

    #[ORM\Column(length: 255)]
    private ?string $marque = null;

    #[ORM\Column]
    private ?int $ttr = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\Column(length: 255)]
    private ?string $aneeFab = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $echeance = null;

    #[ORM\Column(length: 255)]
    private ?string $chassis = null;

    #[ORM\ManyToOne(inversedBy: 'assurances')]
    private ?Detenteur $numPlaque = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumAgreement(): ?int
    {
        return $this->numAgreement;
    }

    public function setNumAgreement(int $numAgreement): static
    {
        $this->numAgreement = $numAgreement;

        return $this;
    }

    public function getNumPolice(): ?string
    {
        return $this->numPolice;
    }

    public function setNumPolice(string $numPolice): static
    {
        $this->numPolice = $numPolice;

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

    public function getTtr(): ?int
    {
        return $this->ttr;
    }

    public function setTtr(int $ttr): static
    {
        $this->ttr = $ttr;

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

    public function getAneeFab(): ?string
    {
        return $this->aneeFab;
    }

    public function setAneeFab(string $aneeFab): static
    {
        $this->aneeFab = $aneeFab;

        return $this;
    }

    public function getEcheance(): ?\DateTimeInterface
    {
        return $this->echeance;
    }

    public function setEcheance(\DateTimeInterface $echeance): static
    {
        $this->echeance = $echeance;

        return $this;
    }

    public function getChassis(): ?string
    {
        return $this->chassis;
    }

    public function setChassis(string $chassis): static
    {
        $this->chassis = $chassis;

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
