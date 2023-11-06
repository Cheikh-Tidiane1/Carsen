<?php

namespace App\Classe ;

use App\Entity\TypeVoiture;

class SearchRent
{
    public ?\DateTimeInterface $dateDebut = null;
    public ?\DateTimeInterface $dateFin =null;

    public array|TypeVoiture $typeVoiture = [];

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

   /* public function __toString(): string
    {
        $txt = $this->dateDebut;
        $txt.= $this->dateFin;
        return  $txt;
    }
   */




}