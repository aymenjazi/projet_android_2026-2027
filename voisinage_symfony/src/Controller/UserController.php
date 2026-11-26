<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

#[Route('/user')]
final class UserController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em){}
    /*#[Route('/user', name: 'app_user')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }*/
    #[Route("/insert_user",methods:['POST'])]
    public function insertUser(Request $request):?JsonResponse{
        $T=$request->toArray();
        if($T["nom"]==null){
            return $this->json(['error'=>true,'message'=>'nom is empty']);
        }
        if($T["prenom"]==null){
            return $this->json(['error'=>true,'message'=>"prenom is missing"]);
        }
        if($T["email"]==null){
            return $this->json(['error'=>true,'message'=>"email is missing"]);
        }
        if($T["login"]==null){
            return $this->json(['error'=>true,'message'=>"login is missing"]);
        }
        if($T["motDePasseHash"]==null){
            return $this->json(['error'=>true,'message'=>"password is missing"]);
        }
        if($T["telephone"]==null){
            return $this->json(['error'=>true,'message'=>"telephone is missing"]);
        }
        if($T["photo"]==null){
            return $this->json(['error'=>true,'message'=>"photo is missing"]);
        }
        if($T["role"]==null){
            return $this->json(['error'=>true,'message'=>"role is missing"]);
        }
        $user=new User();
        $user->setNom($T["nom"]);
        $user->setPrenom($T["prenom"]);
        $user->setEmail($T["email"]);
        $user->setLogin($T["login"]);
        $user->setMotDePasseHash($T["motDePasseHash"]);
        $user->setTelephone($T["telephone"]);
        $user->setPhoto($T["photo"]);
        $user->setRole($T["role"]);
        $this->em->persist($user);
        try{
            $this->em->flush();
        }
        catch(Exception $e){
            return $this->json(['error'=>true,'message'=>$e->getMessage()]);
        }
        return $this->json(["message"=>"User inserted successfully"],500);
    }
}
