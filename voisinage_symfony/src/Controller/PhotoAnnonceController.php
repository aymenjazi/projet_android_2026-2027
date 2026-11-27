<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Annonce;
use App\Entity\PhotoAnnonce;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
#[Route('/photoAnnonce')]
final class PhotoAnnonceController extends AbstractController
{
    public function __construct(private EntityManagerInterface $em,private SluggerInterface $slugger,#[Autowire('%annonces_photos_dir%')]private string $PhotouploadDir){}
    /*#[Route('/photo/annonce', name: 'app_photo_annonce')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/PhotoAnnonceController.php',
        ]);
    }*/
    #[Route("/insert_photoAnnonce",methods:['POST'])]
    public function insertPhoto(Request $request): JsonResponse {
        /*return $this->json([
        'content_type' => $request->headers->get('Content-Type'),
        'post'  => $request->request->all(),
        'files' => array_keys($request->files->all()),
        ]);*/
        $annonceId = $request->request->get('annonce_id');
        if ($annonceId==null) {
            return $this->json(['error' => true, 'message' => 'Annonce should be mentioned'], 400);
        }

        $annonce = $this->em->getRepository(Annonce::class)->find($annonceId);
        if ($annonce==null) {
            return $this->json(['error' => true, 'message' => 'Annonce not found'], 404);
        }

        $file = $request->files->get('photo');
        if ($file==null) {
            return $this->json(['error' => true, 'message' => 'photo file is missing'], 400);
        }
        $allowedMimeTypes = ['image/jpeg', 'image/png'];
        if (!in_array($file->getMimeType(), $allowedMimeTypes, true)) {
            return $this->json(['error' => true, 'message' => 'Invalid image type'], 400);
        }
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $extension = $file->guessExtension();
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $extension;
        try {
            $file->move($this->PhotouploadDir, $newFilename);
        } catch (FileException $e) {
            return $this->json(['error' => true, 'message' => 'Upload failed: ' . $e->getMessage()], 500);
        }
        $photo = new PhotoAnnonce();
        $photo->setUrlPhoto('/uploads/annonces/' . $newFilename);
        $photo->setAnnonce($annonce);

        $this->em->persist($photo);
        $this->em->flush();

        return $this->json([
            'success' => true,
            'id' => $photo->getId(),
            'filename' => $newFilename,
            'url' => '/uploads/annonces/' . $newFilename,
        ], 201);
    }
}

