<?php

namespace App\Controller\Admin;

use App\Entity\Calendrier;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
 
class CalendrierCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Calendrier::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            DateTimeField::new('date'),
            ChoiceField::new('etat')
                ->setChoices([
                    'Disponible' => 1,
                    'Réservé' => 2,
                    'Fermé' => 0,
                ])
                ->renderExpanded(false), // false = menu déroulant, true = boutons radios
            TextField::new('description'),
        ];
    }
}
