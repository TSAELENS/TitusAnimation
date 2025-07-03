<?php

namespace App\Controller;

use App\Repository\AfficheRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CalendrierRepository;
use Symfony\Component\HttpFoundation\JsonResponse;

class AgendaController extends AbstractController
{
    #[Route('/agenda/affiches', name: 'agenda_affiches')]
    public function affiches(AfficheRepository $afficheRepository): Response
    {
        $affiches = $afficheRepository->findBy([], ['date' => 'ASC']);

        return $this->render('agenda/affiches.html.twig', [
            'affiches' => $affiches,
        ]);
    }

    #[Route('/agenda/calendrier', name: 'agenda_calendrier')]
    public function calendrier(): Response
    {
        return $this->render('agenda/calendrier.html.twig');
    }

    #[Route('/agenda/calendrier/data', name: 'agenda_calendrier_data')]
    public function calendrierData(CalendrierRepository $repo): JsonResponse
    {
        $evenements = $repo->findAll();

        $data = [];

        foreach ($evenements as $event) {
            $data[] = [
                'date' => $event->getDate()->format('Y-m-d'),
                'etat' => $event->getEtat(),
                'description' => $event->getDescription(),
            ];
        }

        return new JsonResponse($data);
    }
}
