<?php

namespace App\Controller\Admin;

use App\Entity\Prestation;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Filters;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\Field;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Filter\ChoiceFilter;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PrestationCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Prestation::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Prestation')
            ->setEntityLabelInPlural('Prestations')
            ->setPageTitle(Crud::PAGE_INDEX, 'Gestion des images')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter une nouvelle image')
            ->setPageTitle(Crud::PAGE_EDIT, fn ($entity) => sprintf('Modifier « %s »', $entity->getTitre()))
            ->setPageTitle(Crud::PAGE_DETAIL, fn ($entity) => sprintf('Détail de « %s »', $entity->getTitre()))
            ->setPaginatorPageSize(20)
            ->showEntityActionsInlined(); // optionnel pour style + lisible
    }

    public function configureFilters(Filters $filters): Filters
    {
        return $filters
            ->add( ChoiceFilter::new('page', 'Page')
                ->setChoices([
                    'Prestations Sur Scene'        => 1,
                    'Prestations Sculpture Clown'  => 2,
                    'Prestations Sculpture Conte'  => 3,
                    'Prestations Conte'            => 4,
                    'Prestations Autres'           => 5,
                ])
            )
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('titre'),
            ImageField::new('image')
                ->setBasePath('/uploads/prestation')
                ->onlyOnIndex(),
            Field::new('imageFile')
                ->setFormType(VichImageType::class)
                ->onlyOnForms()
                ->setLabel('Image à uploader'),
            ChoiceField::new('page')
                ->setChoices([
                    'Prestations Sur Scene' => 1,
                    'Prestations Sculpture Clown' => 2,
                    'Prestations Sculpture Conte' => 3,
                    'Prestations Conte' => 4,
                    'Prestations Autres' => 5,
                ])
                ->renderAsBadges([
                    1 => 'primary',
                    2 => 'info',
                    3 => 'success',
                    4 => 'warning',
                    5 => 'danger',
                ])
                ->setFormTypeOption('empty_data', 0),
                IntegerField::new('position', 'Position')
                    ->setFormTypeOption('attr', ['min' => 0]),
        ];
    }
}
