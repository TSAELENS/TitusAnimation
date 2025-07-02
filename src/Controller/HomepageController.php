<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CommentaireRepository;


class HomepageController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    // #[Route('/a-propos', name: 'about')]
    // #[Route('/prestations/sur-scene', name: 'prestations_sur_scene')]
    // #[Route('/prestations/sculpture-fixe', name: 'prestations_sculpture_fixe')]
    // #[Route('/prestations/sculpture-mobile', name: 'prestations_sculpture_mobile')]
    // #[Route('/prestations/decoration', name: 'prestations_decoration')]
    // #[Route('/prestations/conte', name: 'prestations_conte')]
    // #[Route('/livre-dor', name: 'livre_dor')]
    // #[Route('/galerie/photos', name: 'galerie_photos')]
    // #[Route('/galerie/videos', name: 'galerie_videos')]
    // #[Route('/agenda/affiches', name: 'agenda_affiches')]
    // #[Route('/agenda/calendrier', name: 'agenda_calendrier')]
    // #[Route('/devis', name: 'devis')]
    public function index(CommentaireRepository $commentaireRepository): Response
    {
        $commentaire = $commentaireRepository->findBy(['accueil' => true]);

        return $this->render('homepage/index.html.twig', [
            'controller_name' => 'HomepageController',
             'commentaire' => $commentaire
        ]);
    }

}
