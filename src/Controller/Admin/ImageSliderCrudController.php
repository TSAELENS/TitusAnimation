<?php

namespace App\Controller\Admin;

use App\Entity\ImageSlider;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use Vich\UploaderBundle\Form\Type\VichImageType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class ImageSliderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ImageSlider::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Image')
            ->setEntityLabelInPlural('Images du slider')
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
            TextField::new('nom'),
            IntegerField::new('position'),
            TextField::new('slider'),
            ImageField::new('url')
                ->setBasePath('/uploads/sliders')
                ->onlyOnIndex(),
            Field::new('imageFile')
                ->setFormType(VichImageType::class)
                ->onlyOnForms()
                ->setLabel('Image à uploader'),
        ];
    }
}