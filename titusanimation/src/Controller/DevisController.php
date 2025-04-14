<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Mailjet\Client;
use Mailjet\Resources;
use Psr\Log\LoggerInterface;

class DevisController extends AbstractController
{
    #[Route('/devis', name: 'devis')]
    public function index(Request $request, LoggerInterface $logger): Response
    {
        if ($request->isMethod('POST')) {
            $data = $request->request->all();
            $logger->info('Formulaire reçu', $data);

            $mailjet = new Client(
                '0e383667f527d56b565ffe2635da6478',      // ← À remplacer
                '2d1d692ebc0f87b6084ca28d04b558e0',   // ← À remplacer
                true,
                ['version' => 'v3.1']
            );

            $body = [
                'Messages' => [
                    [
                        'From' => [
                            'Email' => "devistitusanimation@gmail.com",
                            'Name' => "Titus Animation"
                        ],
                        'To' => [
                            [
                                'Email' => "pierreemmanuel.declercq@gmail.com",
                                'Name' => "Client"
                            ]
                        ],
                        'TemplateID' => 6900035,
                        //'TemplateID' => 6900252,
                        'TemplateLanguage' => true,
                        'Subject' => "Nouvelle demande de devis",
                        'Variables' => [
                            'prenom' => $data['prenom'] ?? '',
                            'nom' => $data['nom'] ?? '',
                            'adresse' => $data['adresse'] ?? '',
                            'coordonnees' => $data['coordonnees'] ?? '',
                            'lieu_animation' => $data['lieu_animation'] ?? '',
                            'date' => $data['date'] ?? '',
                            'heure' => $data['heure'] ?? '',
                            'infos_complementaires' => $data['infos_complementaires'] ?? '',
                        ]
                    ]
                ]
            ];

            $response = $mailjet->post(Resources::$Email, ['body' => $body]);

            if (!$response->success()) {
                $logger->error('Erreur Mailjet', [
                    'status' => $response->getStatus(),
                    'data' => $response->getData()
                ]);
                $this->addFlash('error', 'Une erreur est survenue lors de l’envoi du mail.');
            } else {
                $logger->info('Mail envoyé avec succès.');
                $this->addFlash('success', 'Demande envoyée avec succès.');
                return $this->redirectToRoute('devis');
            }
        }

        return $this->render('devis/index.html.twig');
    }
}