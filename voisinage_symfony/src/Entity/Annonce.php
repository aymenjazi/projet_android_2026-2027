<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use DateTime;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: AnnonceRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Annonce
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'annonces')]
    #[ORM\JoinColumn(name: 'utilisateur_id', referencedColumnName: 'id', nullable: false)]
    private ?User $u;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'annonces')]
    #[ORM\JoinColumn(name: 'categorie_id', referencedColumnName: 'id', nullable: false)]
    private ?Categorie $c;
    
    #[ORM\Column(name:"titre",length:255,nullable:false)] 
    private ?string $titre; 
    
    #[ORM\Column(name:"description", type:Types::TEXT, nullable:true)] 
    private ?string $description;
    
    #[ORM\Column(name:"type_transaction",length:50,nullable:true)]
    private ?string $type_transaction; 
    
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2,nullable:true)]
    private ?string $prix;
    
    #[ORM\Column(name:"etat_objet",length:100,nullable:true)] 
    private ?string $etat_objet; 
    
    #[ORM\Column(name:"disponibilte",length:100,nullable:true)] 
    private ?string $disponibilite;
    
    #[ORM\OneToMany(targetEntity:PhotoAnnonce::class,mappedBy:'annonce')]
    private ?Collection $photos;
    /*#[ORM\Column(name:"ville",length:100,nullable:true)] 
    private ?string $ville;
    
    #[ORM\Column(name:"quartier",length:100,nullable:true)] 
    private ?string $quartier;*/
    
    #[ORM\ManyToOne(targetEntity: Localisation::class, inversedBy: 'annonces')]
    #[ORM\JoinColumn(name: 'localisation_id', referencedColumnName: 'id', nullable: false)]
    private ?Localisation $localisation;
    
    #[ORM\Column(name:"date_publication",type:"date",nullable:false)]
    private ?DateTime $date_publication;
    function __construct(){$this->photos=new ArrayCollection();}
    
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id){
        $this->id=$id;
    }
    public function setUser(User $u){
        $this->u=$u;
    }
    public function getUser():?User{
        return $this->u;
    }
    public function setCategorie(Categorie $c){
        $this->c=$c;
    }
    public function getCategorie():?Categorie{
        return $this->Categorie;
    }
    public function setTitre(string $titre){
        $this->titre=$titre;
    }
    public function getTitre():?string{
        return $this->titre;
    }
    public function setDescription(string $description){
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
    public function setPrix(string $prix){
        $this->prix=$prix;
    }
    public function getPrix():?string{
        return $this->prix;
    }
    public function setEtatObjet(string $etat_objet){
        $this->etat_objet=$etat_objet;
    }
    public function getEtatObjet():?string{
        $this->etat_objet;
    }
    public function setDisponibilite(string $disponibilite){
        $this->disponibilte=$disponibilite;
    }
    public function getDisponibilite():?string{
        $this->disponibilite=$disponibilite;
    }
    /*public function setVille(string $ville){
        $this->ville=$ville;
    }
    public function getVille():?string{
        return $this->ville;
    }
    public function setQuartier(string $quartier){
        $this->quartier=$quartier;
    }
    public function getQuartier():?string{
        return $this->quartier;
    }*/
    public function setLocalisation(Localisation $localisation){
        $this->localisation=$localisation;
    }
    public function getLocalisation():?Localisation{
        return $this->localisation;
    }
    public function getDatePublication():?DateTime{
        return $this->date_publication;
    }
    #[ORM\PrePersist]
    public function onCreate(){
        $this->date_publication=new DateTime();
    }
}
