<?php

namespace App\Controller\Admin;


use App\Entity\User;
use App\Entity\Carte;
use App\Entity\Contact;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\Routing\Annotation\Route;
use App\Controller\Admin\UserCrudController;
use App\Controller\Admin\CarteCrudController;
use App\Controller\Admin\ContactCrudController;

class adminController extends AbstractDashboardController
{

    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    )   {    
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //demande si le compte à le role admin.
        $url = $this->adminUrlGenerator //génère un URL
        ->setController(UserCrudController::class)//URL pour l'utilisateur
        ->setController(CarteCrudController::class)//URL pour les cartes
        ->setController(ContactCrudController::class)//URL pour les contact
        ->generateUrl();
        return $this->redirect($url);
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="assets/img/favicon.png" class="img-fluid d-block mx-auto" style="max-width:100px; width:100%;">')
            ;
    }

    public function configureMenuItems(): iterable //configure 
    {
        yield MenuItem::linkToUrl('home', 'fas fa-home', '/');
        yield MenuItem::linkToCrud('Utilisateur', 'fas fa-list', User::class);
        yield MenuItem::linkToCrud('Carte', 'fas fa-list', Carte::class);
        yield MenuItem::linkToCrud('Contact', 'fas fa-list', Contact::class);
    }
}
