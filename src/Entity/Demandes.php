<?php

namespace App\Entity;

use App\Repository\DemandesRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandesRepository::class)]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: 'type', type: 'string')]
#[ORM\DiscriminatorMap(['demandeVente'=>DemandeVente::class, 'demandeLocation'=>DemandeLocation::class])]
class Demandes
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    protected ?int $id = null;

    #[ORM\Column(length: 255)]
    protected ?string $typeVoiture = null;

    #[ORM\Column(length: 255)]
    protected ?string $marque = null;

    #[ORM\Column(length: 255)]
    protected ?string $modele = null;

    #[ORM\Column]
    protected ?float $prix = null;

    #[ORM\Column(length: 255)]
    protected ?string $photo = null;

    #[ORM\Column(length: 255)]
    protected ?string $date = null;

    #[ORM\ManyToOne(inversedBy: 'demandes')]
    #[ORM\JoinColumn(nullable: false)]
    protected ?Proprietaire $proprietaire = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTypeVoiture(): ?string
    {
        return $this->typeVoiture;
    }

    public function setTypeVoiture(string $typeVoiture): self
    {
        $this->typeVoiture = $typeVoiture;

        return $this;
    }

    public function getMarque(): ?string
    {
        return $this->marque;
    }

    public function setMarque(string $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(float $prix): self
    {
        $this->prix = $prix;

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

    public function getDate(): ?string
    {
        return $this->date;
    }

    public function setDate(string $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getProprietaire(): ?Proprietaire
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?Proprietaire $proprietaire): self
    {
        $this->proprietaire = $proprietaire;

        return $this;
    }
}
