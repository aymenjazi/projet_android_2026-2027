<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;

#[Route("/categorie")]
final class CategorieController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em)
    {}
    /*#[Route('/categorie', name: 'app_categorie')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CategorieController.php',
        ]);
    }*/
    #[Route("/insert_categorie",methods:['POST'])]
    public function insertCategorie(Request $request):?JsonResponse{
        $T=$request->toArray();
        if($T["libelle"]==null){
            return $this->json(['error'=>true,'message'=>'libelle is empty']);
        }
        $categorie=new Categorie();
        $categorie->setLibelle($T["libelle"]);
        $this->em->persist($categorie);
        try{
            $this->em->flush();
        }
        catch(Exception $e){
            return this->json(['message'=>$e->getMessage()]);
        }
        return $this->json(["message"=>"categorie inserted successfully"],500);
    }
}
