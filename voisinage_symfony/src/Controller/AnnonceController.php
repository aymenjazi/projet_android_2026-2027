<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\AnnonceRepository;
use App\Entity\Annonce;
use App\Entity\Localisation;
use App\Entity\User;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;

#[Route("/annonce")]
final class AnnonceController extends AbstractController
{
    
    public function __construct(private AnnonceRepository $annonce_repository,private EntityManagerInterface $em){

    }
    /*#[Route('/annonce', name: 'app_annonce')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/AnnonceController.php',
        ]);
    }*/
    #[Route("/get_annonces",methods:['GET'])]
    public function getAllAnnonces():?JsonResponse{
        $annonces=$this->annonce_repository->findAll();
        return $this->json($annonces);
    }
    #[Route("/{libelle}/get_annonces_par_libelle",methods:['GET'])]
    public function getAnnoncesByCategorieLibelle(string $libelle):?JsonResponse{
        $annonces=$this->annonce_repository->findByCategorieLibelle($libelle);
        return $this->json($annonces);
    }
    #[Route("/{type_transaction}/get_annonces_par_libelle",methods:['GET'])]
    public function getAnnoncesByTypeTransaction(string $type_transaction):?JsonResponse{
        $annonces=$this->annonce_repository->findByTypeTransaction($type_transaction);
        return $this->json($annonces);
    }
    #[Route("/{etat_objet}/get_annonces_par_etat_objet",methods:['GET'])]
    public function getAnnoncesByEtatObjet(string $etat_objet):?JsonResponse{
        $annonces=$this->annonce_repository->findByEtatObjet($etat_objet);
        
        return $this->json($annonces);
    }
    #[Route("/{prix}/get_annonces_par_prix",methods:['GET'])]
    public function getAnnoncesByPrix(string $prix):?JsonResponse{
        $annonces=$this->annonces_repository->findByPrix($prix);
        return $this->json($annonces);
    }
    #[Route("/insert_annonce",methods:['POST'])]
    public function insertAnnonce(Request $request):?JsonResponse{
        $T=$request->toArray();
        $annonce=new Annonce();
        if($T["titre"]==null){
            return $this->json(['error'=>true,'message'=>'titre is empty']);
        }
        if($T["description"]==null){
            return $this->json(['error'=>true,'message'=>"description is missing"]);
        }
        if($T["type_transaction"]==null){
            return $this->json(['error'=>true,'message'=>"type de transaction is missing"]);
        }
        if($T["prix"]==null){
            return $this->json(['error'=>true,'message'=>"prix is missing"]);
        }
        if($T["etat_objet"]==null){
            return $this->json(['error'=>true,'message'=>"etat_objet is missing"]);
        }
        if($T["disponibilite"]==null){
            return $this->json(['error'=>true,'message'=>"disponibilite is missing"]);
        }
        if($T["localisation"]==null){
            return $this->json(['error'=>true,'message'=>"localisation is missing"]);
        }
        $localisation=$this->em->getRepository(Localisation::class)->find($T["localisation"]["id"]);
        if($localisation==null){
            return $this->json(['error'=>true,'message'=>"localisation unavailable"]);
        }
        if($T["u"]==null){
            return $this->json(['error'=>true,'message'=>"user is missing"]);
        }
        $user=$this->em->getRepository(User::class)->find($T["u"]["id"]);
        if($user==null){
            return $this->json(['error'=>true,'message'=>"User unavailable"]);
        }
        if($T["c"]==null){
            return $this->json(['error'=>true,'message'=>"categorie is missing"]);
        }
        $categorie=$this->em->getRepository(Categorie::class)->find($T["c"]["id"]);
        if($categorie==null){
            return $this->json(['error'=>true,'message'=>"categorie unavailable"]);
        }
        $annonce->setTitre($T["titre"]);
        $annonce->setDescription($T["description"]);
        $annonce->setTypeTransaction($T["type_transaction"]);
        $annonce->setPrix($T["prix"]);
        $annonce->setEtatObjet($T["etat_objet"]);
        $annonce->setDisponibilite($T["disponibilite"]);
        $annonce->setCategorie($categorie);
        $annonce->setUser($user);
        $annonce->setLocalisation($localisation);
        $this->em->persist($annonce);
        try{
            $this->em->flush();
        }
        catch(Exception $e){
            return $this->json(['error'=>true,'message'=>$e->getMessage()]);
        }
        return $this->json(["success"=>true,"message"=>"Annonce inserted successfully"],500);
    }
}
