<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AgendaController extends AbstractController
{
    // #[Route('/agenda', name: 'app_agenda')]
    // public function index(): Response
    // {
    //     return $this->render('agenda/index.html.twig', [
    //         'controller_name' => 'AgendaController',
    //     ]);
    // }
    #[Route('/agenda/affiches', name: 'agenda_affiches')]
    public function affiches(): Response
    {
        return $this->render('agenda/affiches.html.twig');
    }

    #[Route('/agenda/calendrier', name: 'agenda_calendrier')]
    public function calendrier(): Response
    {
        return $this->render('agenda/calendrier.html.twig');
    }

}
