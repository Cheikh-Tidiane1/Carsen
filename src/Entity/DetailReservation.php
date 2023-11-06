<?php

namespace App\Entity;

use App\Repository\DetailReservationRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DetailReservationRepository::class)]
class DetailReservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?float $prixJour = null;

    #[ORM\Column(length: 255)]
    private ?string $nombreJour = null;

    #[ORM\Column]
    private ?float $total = null;

    #[ORM\ManyToOne(inversedBy: 'detailReservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Reservation $reservation = null;

    #[ORM\Column(length: 255)]
    private ?string $voiture = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrixJour(): ?float
    {
        return $this->prixJour;
    }

    public function setPrixJour(float $prixJour): self
    {
        $this->prixJour = $prixJour;

        return $this;
    }

    public function getNombreJour(): ?string
    {
        return $this->nombreJour;
    }

    public function setNombreJour(string $nombreJour): self
    {
        $this->nombreJour = $nombreJour;

        return $this;
    }

    public function getTotal(): ?float
    {
        return $this->total;
    }

    public function setTotal(float $total): self
    {
        $this->total = $total;

        return $this;
    }

    public function getReservation(): ?Reservation
    {
        return $this->reservation;
    }

    public function setReservation(?Reservation $reservation): self
    {
        $this->reservation = $reservation;

        return $this;
    }

    public function getVoiture(): ?string
    {
        return $this->voiture;
    }

    public function setVoiture(string $voiture): self
    {
        $this->voiture = $voiture;

        return $this;
    }
}
