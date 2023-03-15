<?php

namespace App\Controller\Admin;

use App\Entity\Carte;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;

class CarteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Carte::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('id', 'ID')->hideOnForm(),
            TextField::new('contenu'),
            BooleanField::new('estPublique', 'Est publique'),
        ];
    }
}
