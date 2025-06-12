<?php

namespace App\Controller\Admin;

use App\Entity\ImageGallery;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Vich\UploaderBundle\Form\Type\VichImageType;

class ImageGalleryCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ImageGallery::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Image')
            ->setEntityLabelInPlural('Galerie')
            ->setPageTitle(Crud::PAGE_INDEX, 'Gestion des images')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter une nouvelle image')
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
            ImageField::new('image')
                ->setBasePath('/uploads/gallery')
                ->onlyOnIndex(),
            Field::new('imageFile')
                ->setFormType(VichImageType::class)
                ->onlyOnForms()
                ->setLabel('Image à uploader'),
            ChoiceField::new('page')
                ->setChoices([
                    'Sur scène' => 1,
                    'Sculpture fixe' => 2,
                    'Sculpture mobile' => 3,
                    'Décoration' => 4,
                    'Conte (médiéval)' => 5,
                ])
                ->renderAsBadges([
                    1 => 'primary',
                    2 => 'info',
                    3 => 'success',
                    4 => 'warning',
                    5 => 'danger',
                ])
                ->setFormTypeOption('empty_data', 0),
        ];
    }
}
