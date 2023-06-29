<?php

namespace App\Entity;

use App\Repository\LieuRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LieuRepository::class)]
class Lieu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\ManyToOne(inversedBy: 'lieu')]
    private ?Ville $ville = null;

    #[ORM\ManyToMany(targetEntity: CategoriePoisson::class, mappedBy: 'lieu')]
    private Collection $categoriePoissons;

    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'lieus')]
    private Collection $pecheurs;

    public function __construct()
    {
        $this->categoriePoissons = new ArrayCollection();
        $this->pecheurs = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function getVille(): ?Ville
    {
        return $this->ville;
    }

    public function setVille(?Ville $ville): static
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * @return Collection<int, CategoriePoisson>
     */
    public function getCategoriePoissons(): Collection
    {
        return $this->categoriePoissons;
    }

    public function addCategoriePoisson(CategoriePoisson $categoriePoisson): static
    {
        if (!$this->categoriePoissons->contains($categoriePoisson)) {
            $this->categoriePoissons->add($categoriePoisson);
            $categoriePoisson->addLieu($this);
        }

        return $this;
    }

    public function removeCategoriePoisson(CategoriePoisson $categoriePoisson): static
    {
        if ($this->categoriePoissons->removeElement($categoriePoisson)) {
            $categoriePoisson->removeLieu($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getPecheurs(): Collection
    {
        return $this->pecheurs;
    }

    public function addPecheur(User $pecheur): static
    {
        if (!$this->pecheurs->contains($pecheur)) {
            $this->pecheurs->add($pecheur);
        }

        return $this;
    }

    public function removePecheur(User $pecheur): static
    {
        $this->pecheurs->removeElement($pecheur);

        return $this;
    }
}
