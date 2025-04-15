<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/api/events', name: 'api_events')]
    public function events(): JsonResponse
    {
        $events = [
            [
                'title' => 'Pas disponible',
                'start' => '2023-05-10',
                'color' => 'red',
            ],
            [
                'title' => 'Réservé',
                'start' => '2023-05-15',
                'color' => 'blue',
            ],
            [
                'title' => 'Disponible',
                'start' => '2023-05-20',
                'color' => 'green',
            ],
        ];

        return new JsonResponse($events);
    }
}
