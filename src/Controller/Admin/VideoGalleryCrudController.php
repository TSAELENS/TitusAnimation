<?php

namespace App\Controller\Admin;

use App\Entity\VideoGallery;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class VideoGalleryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return VideoGallery::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Vidéo')
            ->setEntityLabelInPlural('Galerie Vidéos')
            ->setPageTitle(Crud::PAGE_INDEX, 'Gestion des vidéos')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter une nouvelle vidéo')
            ->setPageTitle(Crud::PAGE_EDIT, fn ($entity) => sprintf('Modifier « %s »', $entity->getTitre()))
            ->setPageTitle(Crud::PAGE_DETAIL, fn ($entity) => sprintf('Détail de « %s »', $entity->getTitre()))
            ->setPaginatorPageSize(20)
            ->showEntityActionsInlined(); // optionnel pour style + lisible
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
                    if (!$value) {
                        return '<span style="color: grey;">(Pas de lien)</span>';
                    }
    
                    // Ajouter le protocole si manquant
                    if (!str_starts_with($value, 'http')) {
                        $value = 'https://' . $value;
                    }
    
                    // ▶️ YouTube : watch?v=ID
                    if (preg_match('#youtube\.com/watch\?v=([\w\-]+)#', $value, $matches)) {
                        $videoId = $matches[1];
                        return sprintf('<iframe width="320" height="180" src="https://www.youtube.com/embed/%s" frameborder="0" allowfullscreen></iframe>', $videoId);
                    }
    
                    // ▶️ YouTube : youtu.be/ID
                    if (preg_match('#youtu\.be/([\w\-]+)#', $value, $matches)) {
                        $videoId = $matches[1];
                        return sprintf('<iframe width="320" height="180" src="https://www.youtube.com/embed/%s" frameborder="0" allowfullscreen></iframe>', $videoId);
                    }
    
                    // ▶️ YouTube Shorts
                    if (preg_match('#youtube\.com/shorts/([\w\-]+)#', $value, $matches)) {
                        $videoId = $matches[1];
                        return sprintf('<iframe width="320" height="180" src="https://www.youtube.com/embed/%s" frameborder="0" allowfullscreen></iframe>', $videoId);
                    }
    
                    // 📸 Instagram
                    if (str_contains($value, 'instagram.com')) {
                        // Ajoute /embed à la fin si pas déjà présent
                        if (!str_ends_with($value, '/embed')) {
                            $value = rtrim($value, '/') . '/embed';
                        }
                        return sprintf('<iframe src="%s" width="320" height="400" frameborder="0" allowtransparency="true" scrolling="no"></iframe>', $value);
                    }

                    // TikTok
                    if (str_contains($value, 'tiktok.com')) {
                        $id = explode('/video/', $value)[1] ?? null;
                        if ($id) {
                            return sprintf('
                                <blockquote class="tiktok-embed" cite="%s" data-video-id="%s">
                                    <a href="%s">Voir sur TikTok</a>
                                </blockquote>
                                <script async src="https://www.tiktok.com/embed.js"></script>',
                                $value, explode('?', $id)[0], $value
                            );
                        }
                    }
            
                    // Facebook
                    if (str_contains($value, 'facebook.com')) {
                        return sprintf('<iframe src="https://www.facebook.com/plugins/video.php?href=%s&show_text=0" width="320" height="400" style="border:none;overflow:hidden" scrolling="no" frameborder="0" allowfullscreen allow="autoplay; clipboard-write; encrypted-media; picture-in-picture; web-share"></iframe>', urlencode($value));
                    }
                    return '<span style="color:red;">Lien non reconnu</span>';
                }),
        ];
    }
}
