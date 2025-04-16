<?php

namespace App\Controller\Admin;

use App\Entity\ImageSlider;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class ImageSliderCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ImageSlider::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            UrlField::new('url'),
            IntegerField::new('position'),
            TextField::new('slider'),
        ];
    }
}
