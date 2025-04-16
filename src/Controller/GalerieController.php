<?php

namespace App\Controller;

use App\Repository\ImageGalleryRepository;
use App\Repository\VideoGalleryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GalerieController extends AbstractController
{
    // #[Route('/galerie', name: 'app_galerie')]
    // public function index(): Response
    // {
    //     return $this->render('galerie/index.html.twig', [
    //         'controller_name' => 'GalerieController',
    //     ]);
    // }
    #[Route('/galerie', name: 'galerie_photos')]
    public function photos(ImageGalleryRepository $imageGalleryRepository): Response
    {
        $images = $imageGalleryRepository->findAll();

        return $this->render('galerie/photos.html.twig', [
            'images' => $images,
        ]);
    }

    #[Route('/galerie/videos', name: 'galerie_videos')]
    public function videos(VideoGalleryRepository $videoGalleryRepository): Response
    {
        $videos = $videoGalleryRepository->findAll();

        return $this->render('galerie/videos.html.twig', [
            'videos' => $videos,
        ]);
    }
}
