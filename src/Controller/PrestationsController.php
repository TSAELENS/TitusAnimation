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

    #[Route('/prestations/sculpture-fixe', name: 'prestations_sculpture_fixe')]
    public function sculptureFixe(): Response
    {
        return $this->render('prestations/sculpture_fixe.html.twig');
    }

    #[Route('/prestations/sculpture-mobile', name: 'prestations_sculpture_mobile')]
    public function sculptureMobile(): Response
    {
        return $this->render('prestations/sculpture_mobile.html.twig');
    }

    #[Route('/prestations/decoration', name: 'prestations_decoration')]
    public function decoration(): Response
    {
        return $this->render('prestations/decoration.html.twig');
    }

    #[Route('/prestations/comte', name: 'prestations_comte')]
    public function comte(): Response
    {
        return $this->render('prestations/comte.html.twig');
    }
}
