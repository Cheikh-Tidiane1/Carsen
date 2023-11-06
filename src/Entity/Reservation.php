<?php

namespace App\Entity;

use App\Repository\ReservationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ReservationRepository::class)]
class Reservation
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $NumeroReservation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateReservation = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateFin = null;

    #[ORM\Column(length: 255)]
    private ?string $ModePaiement = null;

    #[ORM\Column(length: 255)]
    private ?string $ModeLivraison = null;

    #[ORM\ManyToOne(inversedBy: 'reservations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    #[ORM\Column(length: 255)]
    private ?string $paiementEffectue = null;

    #[ORM\Column(length: 255)]
    private ?string $adresseLivraison = null;

    #[ORM\OneToMany(mappedBy: 'reservation', targetEntity: DetailReservation::class)]
    private Collection $detailReservations;

    public function __construct()
    {
        $this->detailReservations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumeroReservation(): ?string
    {
        return $this->NumeroReservation;
    }

    public function setNumeroReservation(string $NumeroReservation): self
    {
        $this->NumeroReservation = $NumeroReservation;

        return $this;
    }

    public function getDateReservation(): ?\DateTimeInterface
    {
        return $this->dateReservation;
    }

    public function setDateReservation(\DateTimeInterface $dateReservation): self
    {
        $this->dateReservation = $dateReservation;

        return $this;
    }

    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    public function setDateFin(\DateTimeInterface $dateFin): self
    {
        $this->dateFin = $dateFin;

        return $this;
    }

    public function getModePaiement(): ?string
    {
        return $this->ModePaiement;
    }

    public function setModePaiement(string $ModePaiement): self
    {
        $this->ModePaiement = $ModePaiement;

        return $this;
    }

    public function getModeLivraison(): ?string
    {
        return $this->ModeLivraison;
    }

    public function setModeLivraison(string $ModeLivraison): self
    {
        $this->ModeLivraison = $ModeLivraison;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getPaiementEffectue(): ?string
    {
        return $this->paiementEffectue;
    }

    public function setPaiementEffectue(string $paiementEffectue): self
    {
        $this->paiementEffectue = $paiementEffectue;

        return $this;
    }

    public function getAdresseLivraison(): ?string
    {
        return $this->adresseLivraison;
    }

    public function setAdresseLivraison(string $adresseLivraison): self
    {
        $this->adresseLivraison = $adresseLivraison;

        return $this;
    }

    /**
     * @return Collection<int, DetailReservation>
     */
    public function getDetailReservations(): Collection
    {
        return $this->detailReservations;
    }

    public function addDetailReservation(DetailReservation $detailReservation): self
    {
        if (!$this->detailReservations->contains($detailReservation)) {
            $this->detailReservations->add($detailReservation);
            $detailReservation->setReservation($this);
        }

        return $this;
    }

    public function removeDetailReservation(DetailReservation $detailReservation): self
    {
        if ($this->detailReservations->removeElement($detailReservation)) {
            // set the owning side to null (unless already changed)
            if ($detailReservation->getReservation() === $this) {
                $detailReservation->setReservation(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        $txt = $this->dateFin;
        $txt.= $this->dateFin;
        return $txt ;
    }


}
