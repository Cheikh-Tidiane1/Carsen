<?php

namespace App\Entity;

use App\Repository\DemandeVenteRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DemandeVenteRepository::class)]
class DemandeVente extends Demandes
{



    #[ORM\Column(length: 255)]
    private ?string $etat = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEtat(): ?string
    {
        return $this->etat;
    }

    public function setEtat(string $etat): self
    {
        $this->etat = $etat;

        return $this;
    }




}
