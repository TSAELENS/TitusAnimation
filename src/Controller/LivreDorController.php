<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Commentaire;

class LivreDorController extends AbstractController
{
    #[Route('/livre-dor', name: 'livre_dor', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $em, CsrfTokenManagerInterface $csrfTokenManager): Response
    {
        // GESTION DU FORMULAIRE POST
        if ($request->isMethod('POST')) {
            $auteur = trim($request->request->get('auteur', ''));
            $contenu = trim($request->request->get('contenu', ''));
            $csrfToken = $request->request->get('_csrf_token');

            // Vérifier le CSRF
            if (!$csrfTokenManager->isTokenValid(new \Symfony\Component\Security\Csrf\CsrfToken('ajouter_avis', $csrfToken))) {
                $this->addFlash('danger', 'Erreur de sécurité.');
                return $this->redirectToRoute('livre_dor');
            }

            // Vérifier les champs
            if ($auteur && $contenu) {
                $commentaire = new Commentaire();
                $commentaire->setAuteur($auteur);
                $commentaire->setContenu($contenu);
                $commentaire->setEstPublie(false);


                // Les autres champs (date, validation, etc.) sont normalement gérés automatiquement (voir entité)
                $em->persist($commentaire);
                $em->flush();

                $this->addFlash('success', 'Merci pour votre avis !');
                return $this->redirectToRoute('livre_dor');
            } else {
                $this->addFlash('danger', 'Veuillez remplir tous les champs.');
            }
        }

        // Récupération des commentaires validés
        $commentaires = $em->getRepository(Commentaire::class)->findBy(['estPublie' => true], ['dateCreation' => 'DESC']);

        return $this->render('livre_dor/index.html.twig', [
            'commentaires' => $commentaires
        ]);
    }
}