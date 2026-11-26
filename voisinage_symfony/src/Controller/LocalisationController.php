<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Localisation;

#[Route('/localisation')]
final class LocalisationController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em){}
    /*#[Route('/localisation', name: 'app_localisation')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/LocalisationController.php',
        ]);
    }*/
    #[Route("/insert_localisation",methods:['POST'])]
    public function insertLocalisation(Request $request):?JsonResponse{
        $T=$request->toArray();
        if($T["ville"]==null){
            return $this->json(['error'=>true,'message'=>'ville is empty']);
        }
        if($T["quartier"]==null){
            return $this->json(['error'=>true,'message'=>"quartier is missing"]);
        }
        if($T["latitude"]==null){
            return $this->json(['error'=>true,'message'=>"latitude is missing"]);
        }
        if($T["longitude"]==null){
            return $this->json(['error'=>true,'message'=>"login is missing"]);
        }
        $localisation=new Localisation();
        $localisation->setVille($T["ville"]);
        $localisation->setQuartier($T["quartier"]);
        $localisation->setLatitude($T["latitude"]);
        $localisation->setLongitude($T["longitude"]);
        $this->em->persist($localisation);
        try{
            $this->em->flush();
        }
        catch(Exception $e){
            return $this->json(['error'=>true,'message'=>$e->getMessage()]);
        }
        return $this->json(["message"=>"Localisation inserted successfully"],500);
    }
}
