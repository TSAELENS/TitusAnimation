<?php

namespace App\Controller\Admin;

use App\Entity\VideoGallery;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class VideoGalleryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VideoGallery::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            UrlField::new('videoUrl')->setLabel('Lien de la vidéo'),
            TextField::new('videoUrl', 'Aperçu vidéo')
                ->renderAsHtml()
                ->formatValue(function ($value, $entity) {
                    // Forcer le protocole si absent
                    if (!str_starts_with($value, 'http')) {
                        $value = 'https://' . $value;
                    }
                    // Youtube classique
                    if (preg_match('#youtube\.com/watch\?v=([\w\-]+)#', $value, $matches)) {
                        $videoId = $matches[1];
                        return sprintf(
                            '<iframe width="320" height="180" src="https://www.youtube.com/embed/%s" frameborder="0" allowfullscreen></iframe>',
                            $videoId
                        );
                    }
                    // Youtube raccourci
                    if (preg_match('#youtu\.be/([\w\-]+)#', $value, $matches)) {
                        $videoId = $matches[1];
                        return sprintf(
                            '<iframe width="320" height="180" src="https://www.youtube.com/embed/%s" frameborder="0" allowfullscreen></iframe>',
                            $videoId
                        );
                    }
                    return '<span style="color:red;">Lien non reconnu</span>';
                }),
        ];
    }
}
