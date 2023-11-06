<?php

namespace App\Entity;

use App\Repository\MarqueRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MarqueRepository::class)]
class Marque
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\OneToMany(mappedBy: 'marque', targetEntity: Voiture::class)]
    private Collection $voitures;

    #[ORM\OneToMany(mappedBy: 'marque', targetEntity: VoitureLoc::class)]
    private Collection $voitureLocs;

    public function __construct()
    {
        $this->voitures = new ArrayCollection();
        $this->voitureLocs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Voiture>
     */
    public function getVoitures(): Collection
    {
        return $this->voitures;
    }

    public function addVoiture(Voiture $voiture): self
    {
        if (!$this->voitures->contains($voiture)) {
            $this->voitures->add($voiture);
            $voiture->setMarque($this);
        }

        return $this;
    }

    public function removeVoiture(Voiture $voiture): self
    {
        if ($this->voitures->removeElement($voiture)) {
            // set the owning side to null (unless already changed)
            if ($voiture->getMarque() === $this) {
                $voiture->setMarque(null);
            }
        }

        return $this;
    }

    public function __toString(): string
    {
        return $this->getNom();
    }

    /**
     * @return Collection<int, VoitureLoc>
     */
    public function getVoitureLocs(): Collection
    {
        return $this->voitureLocs;
    }

    public function addVoitureLoc(VoitureLoc $voitureLoc): self
    {
        if (!$this->voitureLocs->contains($voitureLoc)) {
            $this->voitureLocs->add($voitureLoc);
            $voitureLoc->setMarque($this);
        }

        return $this;
    }

    public function removeVoitureLoc(VoitureLoc $voitureLoc): self
    {
        if ($this->voitureLocs->removeElement($voitureLoc)) {
            // set the owning side to null (unless already changed)
            if ($voitureLoc->getMarque() === $this) {
                $voitureLoc->setMarque(null);
            }
        }

        return $this;
    }
}
