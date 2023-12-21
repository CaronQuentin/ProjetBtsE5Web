<?php

namespace App\Entity;

use App\Repository\CommandeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CommandeRepository::class)]
class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Date_commande = null;

    #[ORM\Column(type: Types::SIMPLE_ARRAY)]
    private array $List_nom = [];

    #[ORM\Column(type: Types::SIMPLE_ARRAY)]
    private array $List_prix = [];

    #[ORM\Column(type: Types::SIMPLE_ARRAY)]
    private array $List_quantite = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateCommande(): ?string
    {
        return $this->Date_commande;
    }

    public function setDateCommande(string $Date_commande): static
    {
        $this->Date_commande = $Date_commande;

        return $this;
    }

    public function getListNom(): array
    {
        return $this->List_nom;
    }

    public function setListNom(array $List_nom): static
    {
        $this->List_nom = $List_nom;

        return $this;
    }

    public function getListPrix(): array
    {
        return $this->List_prix;
    }

    public function setListPrix(array $List_prix): static
    {
        $this->List_prix = $List_prix;

        return $this;
    }

    public function getListQuantite(): array
    {
        return $this->List_quantite;
    }

    public function setListQuantite(array $List_quantite): static
    {
        $this->List_quantite = $List_quantite;

        return $this;
    }
}
