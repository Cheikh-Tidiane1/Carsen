<?php

namespace App\Entity;

use App\Repository\VoitureLocRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoitureLocRepository::class)]
class VoitureLoc
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    private ?string $modele = null;

    #[ORM\Column]
    private ?float $prix = null;

    #[ORM\Column(length: 255)]
    private ?string $photo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebutDispo = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFinDispo = null;

    #[ORM\Column(length: 255)]
    private ?string $description = null;

    #[ORM\Column(length: 255)]
    private ?string $slug = null;

    #[ORM\ManyToOne(inversedBy: 'voitureLocs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Marque $marque = null;

    #[ORM\ManyToOne(inversedBy: 'voitureLocs')]
    #[ORM\JoinColumn(nullable: false)]
    private ?TypeVoiture $typeVoiture = null;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getDateDebutDispo(): ?\DateTimeInterface
    {
        return $this->dateDebutDispo;
    }

    public function setDateDebutDispo(\DateTimeInterface $dateDebutDispo): self
    {
        $this->dateDebutDispo = $dateDebutDispo;

        return $this;
    }

    public function getDateFinDispo(): ?\DateTimeInterface
    {
        return $this->dateFinDispo;
    }

    public function setDateFinDispo(\DateTimeInterface $dateFinDispo): self
    {
        $this->dateFinDispo = $dateFinDispo;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getMarque(): ?Marque
    {
        return $this->marque;
    }

    public function setMarque(?Marque $marque): self
    {
        $this->marque = $marque;

        return $this;
    }

    public function getTypeVoiture(): ?TypeVoiture
    {
        return $this->typeVoiture;
    }

    public function setTypeVoiture(?TypeVoiture $typeVoiture): self
    {
        $this->typeVoiture = $typeVoiture;

        return $this;
    }

    public function __toString(): string
    {
        return $this->getSlug();
    }
}
