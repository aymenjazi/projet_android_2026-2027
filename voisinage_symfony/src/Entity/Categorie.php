<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Attribute\Ignore;
#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name:"libelle",length:100,nullable:false)]
    private ?string $libelle;
    
    #[ORM\OneToMany(targetEntity: Annonce::class, mappedBy:'c')]
    #[Ignore]
    private ?Collection $annonces;
    public function __construct(){$this->annonces=new ArrayCollection();}
    public function setAnnonces(Collection $annonces){
        $this->annonces=$annonces;
    }
    public function getAnnonces():?Collection{
        return $this->annonces;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setLibelle(string $libelle){
        $this->libelle=$libelle;
    }
    public function getLibelle():?string{
        return $this->libelle;
    }
}
