<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(name:"libelle",length:100,nullable:false)]
    private ?string $libelle;
    
   /* #[ORM\Column(name:"description",nullable:false)]
    private ?string $description;
    
    #[ORM\Column(name:"type_transaction",nullable:true)]
    private ?string $type_transaction;
    
    #[ORM\Column(name:"prix",nullable:false)]
    private ?float $prix;*/
    
    #[ORM\OneToMany(targetEntity: Annonce::class, mappedBy:'c')]
    #[Ignore]
    private Collection $annonces;
    
    public function setAnnonces(Collection $annonces){
        $this->annonces=$annonces;
    }
    public function getAnnonces():?Collection{
        return $this->$annonces;
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
    /*public function setDescription(string $description){
        $this->description=$description;
    }
    public function getDescription():?string{
        return $this->description;
    }
    public function setTypeTransaction(string $type_transaction){
        $this->type_transaction=$type_transaction;
    }
    public function getTypeTransaction():?string{
        return $this->type_transaction;
    }
    public function setPrix(float $prix){
        $this->prix=$prix;
    }
    public function getPrix():?float{
        return $this->prix;
    }*/
}
