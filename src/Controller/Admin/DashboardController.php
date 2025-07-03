<?php

namespace App\Controller\Admin;

use App\Entity\Affiche;
use App\Entity\Calendrier;
use App\Entity\Commentaire;
use App\Entity\ImageGallery;
use App\Entity\Prestation;
use App\Entity\VideoGallery;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(CommentaireCrudController::class)->generateUrl());
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);

        // // 👇 Cette ligne génère une URL correcte pour le CRUD de "Commentaire"
        // $url = $adminUrlGenerator
        //     ->setController(CommentaireCrudController::class)
        //     ->setAction('index') // ← très important !
        //     ->generateUrl();

        // return $this->redirect($url);
        //return $this->render('admin/dashboard.html.twig');

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Titusanimation');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Commentaires', 'fas fa-comments', Commentaire::class);
        yield MenuItem::linkToCrud('Images', 'fas fa-images', ImageGallery::class);
        yield MenuItem::linkToCrud('Vidéos', 'fas fa-video', VideoGallery::class);
        yield MenuItem::linkToCrud('Prestation', 'fas fa-images', Prestation::class);
        yield MenuItem::linkToCrud('Affiche', 'fas fa-images', Affiche::class);
        yield MenuItem::linkToCrud('Calendrier', 'fas fa-calendar', Calendrier::class);

        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
