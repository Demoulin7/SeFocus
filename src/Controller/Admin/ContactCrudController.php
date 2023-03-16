<?php

namespace App\Controller\Admin;

use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;

class ContactCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Contact::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('id', 'ID')->hideOnForm(),
            TextField::new('nom', 'Nom'),
            TextField::new('prenom', 'Prenom'),
            EmailField::new('email', 'E-mail'),
            NumberField::new('numeroTelephone', 'Numero de téléphone'),
            TextareaField::new('message', 'Contenu'),
        ];
    }
    
}
