<?php

namespace App\Entity;

use App\Repository\AnnonceRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;
use DateTime;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Attribute\Ignore;
use Symfony\Component\Serializer\Attribute\SerializedName;

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
    private ?User $user;

    #[ORM\ManyToOne(targetEntity: Categorie::class, inversedBy: 'annonces')]
    #[ORM\JoinColumn(name: 'categorie_id', referencedColumnName: 'id', nullable: false)]
    private ?Categorie $categorie;
    
    #[ORM\Column(name:"titre",length:255,nullable:false)] 
    private ?string $titre; 
    
    #[ORM\Column(name:"description", type:Types::TEXT, nullable:true)] 
    private ?string $description;
    
    #[ORM\Column(name:"type_transaction",length:50,nullable:true)]
    private ?string $typeTransaction; 
    
    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 2,nullable:true)]
    private ?string $prix;
    
    #[ORM\Column(name:"etat_objet",length:100,nullable:true)] 
    private ?string $etatObjet; 
    
    #[ORM\Column(name:"disponibilte",length:100,nullable:true)] 
    private ?string $disponibilite;
    
    #[ORM\OneToMany(targetEntity:PhotoAnnonce::class,mappedBy:'annonce')]
    #[Ignore]
    private ?Collection $photos;

    #[ORM\ManyToOne(targetEntity: Localisation::class, inversedBy: 'annonces')]
    #[ORM\JoinColumn(name: 'localisation_id', referencedColumnName: 'id', nullable: false)]
    private ?Localisation $localisation;
    
    #[ORM\Column(name:"date_publication",type:"date",nullable:false)]
    private ?DateTime $datePublication;
    function __construct(){$this->photos=new ArrayCollection();}
    
    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId(int $id){
        $this->id=$id;
    }
    public function setUser(User $u){
        $this->user=$u;
    }
    public function getUser():?User{
        return $this->user;
    }
    public function setCategorie(Categorie $c){
        $this->categorie=$c;
    }
    public function getCategorie():?Categorie{
        return $this->categorie;
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
        $this->typeTransaction=$typeTransaction;
    }
    public function getTypeTransaction():?string{
        return $this->typeTransaction;
    }
    public function setPrix(string $prix){
        $this->prix=$prix;
    }
    public function getPrix():?string{
        return $this->prix;
    }
    public function setEtatObjet(string $etat_objet){
        $this->etatObjet=$etatObjet;
    }
    public function getEtatObjet():?string{
        return $this->etatObjet;
    }
    public function setDisponibilite(string $disponibilite){
        $this->disponibilite=$disponibilite;
    }
    public function getDisponibilite():?string{
        return $this->disponibilite;
    }
    public function setLocalisation(Localisation $localisation){
        $this->localisation=$localisation;
    }
    public function getLocalisation():?Localisation{
        return $this->localisation;
    }
    public function getDatePublication():?DateTime{
        return $this->datePublication;
    }
    #[ORM\PrePersist]
    public function onCreate(){
        $this->datePublication=new DateTime();
    }
}
