<?php

namespace App\Controller;

use App\Entity\Prestation;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrestationsController extends AbstractController
{
    #[Route('/prestations/sur-scene', name: 'prestations_sur_scene')]
    public function surScene(EntityManagerInterface $em): Response
    {
        $images = $em->getRepository(Prestation::class)
            ->findBy(
                ['page' => 1],
                ['position' => 'ASC']
            );

        $formattedImages = [];
        foreach ($images as $image) {
            $formattedImages[] = [
                'title' => $image->getTitre(),
                'url'   => $image->getImage(),
            ];
        }

        return $this->render('prestations/sur_scene.html.twig', [
            'images' => $formattedImages,
        ]);
    }

    #[Route('/prestations/sculpture-clown', name: 'prestations_sculpture_clown')]
    public function sculptureClown(EntityManagerInterface $em): Response
    {
        $images = $em->getRepository(Prestation::class)
            ->findBy(
                ['page' => 2],
                ['position' => 'ASC']
            );

        $formattedImages = [];
        foreach ($images as $image) {
            $formattedImages[] = [
                'title' => $image->getTitre(),
                'url'   => $image->getImage(),
            ];
        }

        return $this->render('prestations/sculpture_clown.html.twig', [
            'images' => $formattedImages,
        ]);
    }

    #[Route('/prestations/sculpture-conte', name: 'prestations_sculpture_conte')]
    public function sculptureConte(EntityManagerInterface $em): Response
    {
        $images = $em->getRepository(Prestation::class)
            ->findBy(
                ['page' => 3],
                ['position' => 'ASC']
            );

        $formattedImages = [];
        foreach ($images as $image) {
            $formattedImages[] = [
                'title' => $image->getTitre(),
                'url'   => $image->getImage(),
            ];
        }

        return $this->render('prestations/sculpture_conte.html.twig', [
            'images' => $formattedImages,
        ]);
    }

    #[Route('/prestations/autres', name: 'prestations_autres')]
    public function autres(EntityManagerInterface $em): Response
    {
        $images = $em->getRepository(Prestation::class)
            ->findBy(
                ['page' => 5],
                ['position' => 'ASC']
            );

        $formattedImages = [];
        foreach ($images as $image) {
            $formattedImages[] = [
                'title' => $image->getTitre(),
                'url'   => $image->getImage(),
            ];
        }

        return $this->render('prestations/autres.html.twig', [
            'images' => $formattedImages,
        ]);
    }

    #[Route('/prestations/conte', name: 'prestations_conte')]
    public function conte(EntityManagerInterface $em): Response
    {
        $images = $em->getRepository(Prestation::class)
            ->findBy(
                ['page' => 4],
                ['position' => 'ASC']
            );

        $formattedImages = [];
        foreach ($images as $image) {
            $formattedImages[] = [
                'title' => $image->getTitre(),
                'url'   => $image->getImage(),
            ];
        }

        return $this->render('prestations/conte.html.twig', [
            'images' => $formattedImages,
        ]);
    }
}
