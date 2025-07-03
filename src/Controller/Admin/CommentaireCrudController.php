<?php

namespace App\Controller\Admin;

use App\Entity\Commentaire;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


class CommentaireCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commentaire::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Commentaire')
            ->setEntityLabelInPlural('Commentaires')
            ->setPageTitle(Crud::PAGE_INDEX, 'Gestion des commentaires')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un nouveau Commentaire')
            ->setPageTitle(Crud::PAGE_EDIT, fn ($entity) => sprintf('Modifier « %s »', $entity->getContenu()))
            ->setPageTitle(Crud::PAGE_DETAIL, fn ($entity) => sprintf('Détail de « %s »', $entity->getContenu()))
            ->setPaginatorPageSize(20)
            ->showEntityActionsInlined(); // optionnel pour style + lisible
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextEditorField::new('contenu'),
            DateTimeField::new('date_creation')->hideOnForm(),
            TextField::new('auteur'),
            BooleanField::new('est_publie')->renderAsSwitch(false),
            DateTimeField::new('date_validation')->hideOnForm(),
            BooleanField::new('accueil', 'Afficher sur l’accueil')->renderAsSwitch(false),
        ];
    }





}
