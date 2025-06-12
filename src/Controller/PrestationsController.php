<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestationsController extends AbstractController
{
    #[Route('/prestations/sur-scene', name: 'prestations_sur_scene')]
    public function surScene(): Response
    {
        return $this->render('prestations/sur_scene.html.twig');
    }

    #[Route('/prestations/sculpture-clown', name: 'prestations_sculpture_clown')]
    public function sculptureClown(): Response
    {
        return $this->render('prestations/sculpture_clown.html.twig');
    }

    #[Route('/prestations/sculpture-conte', name: 'prestations_sculpture_conte')]
    public function sculptureConte(): Response
    {
        return $this->render('prestations/sculpture_conte.html.twig');
    }

    #[Route('/prestations/autres', name: 'prestations_autres')]
    public function autres(): Response
    {
        return $this->render('prestations/autres.html.twig');
    }

    #[Route('/prestations/conte', name: 'prestations_conte')]
    public function conte(): Response
    {
        return $this->render('prestations/conte.html.twig');
    }
}
