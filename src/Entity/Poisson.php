<?php

namespace App\Entity;

use App\Repository\PoissonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PoissonRepository::class)]
class Poisson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(type: Types::SMALLINT)]
    private ?int $taille = null;

    #[ORM\Column]
    private ?int $poids = null;

    #[ORM\ManyToOne(inversedBy: 'poissons')]
    #[ORM\JoinColumn(nullable: false)]
    private ?CategoriePoisson $categorie = null;

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

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): static
    {
        $this->taille = $taille;

        return $this;
    }

    public function getPoids(): ?int
    {
        return $this->poids;
    }

    public function setPoids(int $poids): static
    {
        $this->poids = $poids;

        return $this;
    }

    public function getCategorie(): ?CategoriePoisson
    {
        return $this->categorie;
    }

    public function setCategorie(?CategoriePoisson $categorie): static
    {
        $this->categorie = $categorie;

        return $this;
    }
}
