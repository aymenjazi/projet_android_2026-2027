<?php

namespace App\Entity;

use App\Repository\DemandeRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Types;

#[ORM\Entity(repositoryClass: DemandeRepository::class)]
class Demande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[ORM\ManyToOne(targetEntity: Annonce::class, inversedBy: 'demandes')]
    #[ORM\JoinColumn(name: 'annonce_id', referencedColumnName: 'id', nullable: false)]
    private Annonce $a;

    #[ORM\OneToOne(targetEntity: User::class, inversedBy: 'd')]
    #[ORM\JoinColumn(name: 'utilisateur_id', referencedColumnName: 'id', nullable: false)]
    private User $u;

    #[ORM\Column(name:"date_debut",type:"date",nullable:true)]
    private DateTime $date_debut;
    
    #[ORM\Column(name:"date_fin",type:"date",nullable:true)]
    private DateTime $date_fin;

    #[ORM\Column(name:"message",type:Types::TEXT,nullable:true)]
    private string $meesage;

    #[ORM\Column(name:"status",length:50,nullable:true)]
    private string $status;
    
    #[ORM\Column(name:"date_demande",type:"date",nullable:true)]
    private DateTime $date_demande;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setAnnonce(Annonce $a){
        $this->a=$a;
    }
    public function getAnnonce():?Annonce{
        return $this->a;
    }
    public function setUser(User $u){
        $this->u=$u;
    }
    public function getUser():?User{
        return $this->u;
    }
    public function setDateDebut(DateTime $date_debut){
        $this->date_debut=$date_debut;
    }
    public function getDateDebut():?DateTime{
        return $this->date_debut;
    }
    public function setDateFin(DateTime $date_fin){
        $this->date_fin=$date_fin;
    }
    public function getDateFin():?DateTime{
        return $this->date_fin;
    }
    public function setMessage(string $message){
        $this->message=$message;
    }
    public function getMessage():?string{
        return $this->message;
    }
    public function setStatus(string $status){
        $this->status=$status;
    }
    public function getStatus():?string{
        return $this->status;
    }
    public function setDateDemande(DateTime $date_demande){
        $this->date_demande=$date_demande;
    }
    public function getDateDemande():?DateTime{
        return $this->date_demande;
    }
}
