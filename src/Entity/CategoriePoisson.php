<?php

namespace App\Entity;

use App\Repository\CategoriePoissonRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoriePoissonRepository::class)]
class CategoriePoisson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nomCategorie = null;

    #[ORM\OneToMany(mappedBy: 'categorie', targetEntity: Poisson::class, orphanRemoval: true)]
    private Collection $poissons;

    #[ORM\ManyToMany(targetEntity: Lieu::class, inversedBy: 'categoriePoissons')]
    private Collection $lieu;

    public function __construct()
    {
        $this->poissons = new ArrayCollection();
        $this->lieu = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomCategorie(): ?string
    {
        return $this->nomCategorie;
    }

    public function setNomCategorie(string $nomCategorie): static
    {
        $this->nomCategorie = $nomCategorie;

        return $this;
    }

    /**
     * @return Collection<int, Poisson>
     */
    public function getPoissons(): Collection
    {
        return $this->poissons;
    }

    public function addPoisson(Poisson $poisson): static
    {
        if (!$this->poissons->contains($poisson)) {
            $this->poissons->add($poisson);
            $poisson->setCategorie($this);
        }

        return $this;
    }

    public function removePoisson(Poisson $poisson): static
    {
        if ($this->poissons->removeElement($poisson)) {
            // set the owning side to null (unless already changed)
            if ($poisson->getCategorie() === $this) {
                $poisson->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Lieu>
     */
    public function getLieu(): Collection
    {
        return $this->lieu;
    }

    public function addLieu(Lieu $lieu): static
    {
        if (!$this->lieu->contains($lieu)) {
            $this->lieu->add($lieu);
        }

        return $this;
    }

    public function removeLieu(Lieu $lieu): static
    {
        $this->lieu->removeElement($lieu);

        return $this;
    }
}
