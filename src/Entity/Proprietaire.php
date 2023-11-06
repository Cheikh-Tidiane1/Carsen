<?php

namespace App\Entity;

use App\Repository\ProprietaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProprietaireRepository::class)]
class Proprietaire extends User
{


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $ninea = null;

    #[ORM\Column(length: 255)]
    private ?string $cni = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $compteBancaire = null;

    #[ORM\OneToMany(mappedBy: 'proprietaire', targetEntity: Demandes::class)]
    private Collection $demandes;


    public function __construct()
    {
       // $this->demandes = new ArrayCollection();
    }



    public function getNinea(): ?string
    {
        return $this->ninea;
    }

    public function setNinea(?string $ninea): self
    {
        $this->ninea = $ninea;

        return $this;
    }

    public function getCni(): ?string
    {
        return $this->cni;
    }

    public function setCni(string $cni): self
    {
        $this->cni = $cni;

        return $this;
    }

    public function getCompteBancaire(): ?string
    {
        return $this->compteBancaire;
    }

    public function setCompteBancaire(?string $compteBancaire): self
    {
        $this->compteBancaire = $compteBancaire;

        return $this;
    }

    /**
     * @return Collection<int, Demandes>
     */
    public function getDemandes(): Collection
    {
        return $this->demandes;
    }

    public function addDemande(Demandes $demande): self
    {
        if (!$this->demandes->contains($demande)) {
            $this->demandes->add($demande);
            $demande->setProprietaire($this);
        }

        return $this;
    }

    public function removeDemande(Demandes $demande): self
    {
        if ($this->demandes->removeElement($demande)) {
            // set the owning side to null (unless already changed)
            if ($demande->getProprietaire() === $this) {
                $demande->setProprietaire(null);
            }
        }

        return $this;
    }

}
