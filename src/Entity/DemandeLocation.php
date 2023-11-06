<?php

namespace App\Entity;

use App\Repository\DemandeLocationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: DemandeLocationRepository::class)]
class DemandeLocation extends Demandes
{

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateDebut = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $DateFin = null;


    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }


    public function setDateDebut(\DateTimeInterface $dateDebut): self
    {
        $this->dateDebut = $dateDebut;
        return  $this;
    }


    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->DateFin;
    }


    public function setDateFin(\DateTimeInterface $DateFin): self
    {
        $this->DateFin = $DateFin;
        return $this;
    }

   /* public function __toString(): string
    {
        $txt = $this->getDateDebut();
       $txt.=$this->getDateFin();
        return $txt ;
    }
*/

}
