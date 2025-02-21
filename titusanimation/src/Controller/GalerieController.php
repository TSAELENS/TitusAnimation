<?php

namespace App\Controller;

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
    #[Route('/galerie/photos', name: 'galerie_photos')]
    public function photos(): Response
    {
        return $this->render('galerie/photos.html.twig');
    }
    
    #[Route('/galerie/videos', name: 'galerie_videos')]
    public function videos(): Response
    {
        return $this->render('galerie/videos.html.twig');
    }
}
