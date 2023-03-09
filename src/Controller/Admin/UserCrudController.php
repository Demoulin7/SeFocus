<?php

namespace App\Controller\Admin;

use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
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
            NumberField::new('id', 'ID')->hideOnForm(),
            EmailField::new('email', 'E-mail'),
            ArrayField::new('roles', 'Role'),
            TextField::new('password', 'Mot de passe'),
            TextField::new('Nom'),
            TextField::new('Prenom'),
            NumberField::new('nbPomodoro', 'Nombre de pomodoro')->hideOnForm(),
            ArrayField::new('listeCartesTirees', 'Carte tirée')->hideOnForm(),
        ];
    }
    
    
}
