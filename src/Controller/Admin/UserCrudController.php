<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\EmailField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ArrayField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;

class UserCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return User::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            NumberField::new('id', 'ID')->hideOnForm(),//le rend invisible lors de la page de creation.
            TextField::new('Nom'),
            TextField::new('Prenom'),
            EmailField::new('email', 'E-mail'),
            ArrayField::new('roles', 'Role'),
            TextField::new('password', 'Mot de passe')->hideOnIndex(),//rend invisible dans la page admin
            NumberField::new('nbPomodoro', 'Nombre de pomodoro')->hideOnForm(),
            ArrayField::new('listeCartesTirees', 'Carte tirée')->hideOnForm(),
        ];
    }
    
    
}
