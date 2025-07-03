<?php

namespace App\Controller\Admin;

use App\Entity\Affiche;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;

class AfficheCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Affiche::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            ImageField::new('image')
                ->setBasePath('uploads/affiches')
                ->setUploadDir('public/uploads/affiches')
                ->setUploadedFileNamePattern('[slug]-[timestamp].[extension]')
                ->setRequired(true),
            TextField::new('titre'),
            TextField::new('description'),
            DateTimeField::new('date'),
            TextField::new('lieu'),
        ];
    }
}
