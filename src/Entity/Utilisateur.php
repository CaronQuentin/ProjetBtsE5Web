<?php
#src/Entity/Utilisateur.php
namespace App\Entity;

use App\Repository\UtilisateurRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UtilisateurRepository::class)]
class Utilisateur
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $Nom = null;

    #[ORM\Column(length: 255)]
    private ?string $Prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse_mail = null;

    #[ORM\Column(length: 255)]
    private ?string $Mot_de_passe = null;

    #[ORM\Column(length: 255)]
    private ?string $Adresse_postale = null;

    #[ORM\Column(length: 255)]
    private ?string $Numero_de_telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $Id_Role = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): static
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): static
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getAdresseMail(): ?string
    {
        return $this->Adresse_mail;
    }

    public function setAdresseMail(string $Adresse_mail): static
    {
        $this->Adresse_mail = $Adresse_mail;

        return $this;
    }

    public function getMotDePasse(): ?string
    {
        return $this->Mot_de_passe;
    }

    public function setMotDePasse(string $Mot_de_passe): static
    {
        $this->Mot_de_passe = $Mot_de_passe;

        return $this;
    }

    public function getAdressePostale(): ?string
    {
        return $this->Adresse_postale;
    }

    public function setAdressePostale(string $Adresse_postale): static
    {
        $this->Adresse_postale = $Adresse_postale;

        return $this;
    }

    public function getNumeroDeTelephone(): ?string
    {
        return $this->Numero_de_telephone;
    }

    public function setNumeroDeTelephone(string $Numero_de_telephone): static
    {
        $this->Numero_de_telephone = $Numero_de_telephone;

        return $this;
    }

    public function getIdRole(): ?string
    {
        return $this->Id_Role;
    }

    public function setIdRole(string $Id_Role): static
    {
        $this->Id_Role = $Id_Role;

        return $this;
    }
}
