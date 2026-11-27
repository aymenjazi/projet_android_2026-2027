<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: 'Utilisateur')]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 100)]
    private ?string $nom = null;

    #[ORM\Column(length: 100)]
    private ?string $prenom = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column(length: 100)]
    private ?string $login = null;

    #[ORM\Column(name: 'mot_de_passe_hash', length: 255)]
    private ?string $motDePasseHash = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $telephone = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $photo = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $role = null;
    
    #[ORM\OneToMany(targetEntity: Annonce::class, mappedBy: 'u')]
    #[Ignore]
    private Collection $annonces;
    public function __construct(){$this->annonces=new ArrayCollection();}

    public function setAnnonces(Collection $annonces){
        $this->annonces=$annonces;
    }
    public function getAnnonces():?Collection{
        return $this->annonces;
    }
    public function getId(): ?int { return $this->id; }

    public function getNom(): ?string { return $this->nom; }
    public function setNom(string $nom): static { $this->nom = $nom; return $this; }

    public function getPrenom(): ?string { return $this->prenom; }
    public function setPrenom(string $prenom): static { $this->prenom = $prenom; return $this; }

    public function getEmail(): ?string { return $this->email; }
    public function setEmail(string $email): static { $this->email = $email; return $this; }

    public function getLogin(): ?string { return $this->login; }
    public function setLogin(string $login): static { $this->login = $login; return $this; }

    public function getMotDePasseHash(): ?string { return $this->motDePasseHash; }
    public function setMotDePasseHash(string $hash): static { $this->motDePasseHash = $hash; return $this; }

    public function getTelephone(): ?string { return $this->telephone; }
    public function setTelephone(?string $telephone): static { $this->telephone = $telephone; return $this; }

    public function getPhoto(): ?string { return $this->photo; }
    public function setPhoto(?string $photo): static { $this->photo = $photo; return $this; }

    public function getRole(): ?string { return $this->role; }
    public function setRole(?string $role): static { $this->role = $role; return $this; }
}